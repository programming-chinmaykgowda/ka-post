<?php
if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle) {
        return (string)$needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0;
    }
}

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

$region = $_GET["region"];
$division = $_GET["division"];
$subdivision = $_GET["subdivision"];
$aoname = $_GET["aoname"];
$officeType = $_GET["officeType"];
$sortBy = $_GET["sortBy"];
$category = $_GET["category"];
$topBottomOffice = $_GET["topBottomOffice"];

// Replace with your actual database connection
$servername = 'localhost';
$username = 'u562946175_kapost';
$password = 'Kanthu@1982';
$dbname = 'u562946175_kapost';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = ",SUM(net_target) AS net_target, SUM(net_prop_target) AS net_prop_target, SUM(net_tot) AS net_tot, SUM(net_apr_24) AS net_apr_24, SUM(net_may_24) AS net_may_24, SUM(net_jun_24) AS net_jun_24, SUM(net_oct_24) AS net_oct_24,SUM(net_nov_24) AS net_nov_24,SUM(net_jul_24) AS net_jul_24, SUM(net_aug_24) AS net_aug_24, SUM(net_sep_24) AS net_sep_24, SUM(net_dec_24) AS net_dec_24, SUM(net_jan_24) AS net_jan_24, SUM(net_feb_24) AS net_feb_24, SUM(net_mar_24) AS net_mar_24,  (SUM(net_tot)/SUM(net_target))*100 AS `%age`,(SUM(net_tot)/SUM(net_prop_target))*100 AS `%age1`, Remarks,AO_Name,Sub_Division,Division FROM posb_karnataka1_24_25 WHERE 1";

if($region !== "all") {
    $sql .= " AND Region_ID = '$region'"; 
}

if ($division !== "all" && !empty($division)) {
    $sql .= " AND Division_ID = '$division'";
}

if ($subdivision !== "all" && !empty($subdivision)) {
    $sql .= " AND Sub_Division_ID = '$subdivision'";
}

if (!empty($aoname) && $aoname !== "all" && $aoname !== "all_acs") {
    $sql .= " AND AO_Facility_ID = '$aoname'";
}

if (!empty($officeType) && $officeType !== "all") {
    $sql .= " AND Office_Type = '$officeType'";
}

if(!empty($aoname)) {
    if($aoname !== "all_acs") {
        $sql = "SELECT Office_Name AS Name".$sql;
        $sql .= " GROUP BY Facility_ID";
    } else {
        $sql = "SELECT AO_Name AS Name".$sql;
        $sql .= " GROUP BY AO_Facility_ID";
    }
} elseif(!empty($subdivision)) {
    if($subdivision === "all") {
        $sql = "SELECT Sub_Division AS Name".$sql;
        $sql .= " GROUP BY Sub_Division_ID";
    } else {
        $sql = "SELECT AO_Name AS Name".$sql;
        $sql .= " GROUP BY AO_Facility_ID";
    }
} elseif(!empty($division)) {
    $sql = "SELECT Division AS Name".$sql;
    $sql .= " GROUP BY Division_ID";
} else {
    $sql = "SELECT Region AS Name".$sql;
    $sql .= " GROUP BY Region_ID";
} 

if(!empty($sortBy) && !str_contains($topBottomOffice, 'top') && !str_contains($topBottomOffice, 'bottom')) {
    $sql .= " ORDER BY ".$sortBy;
}

if (!empty($category) && isset($topBottomOffice) && $topBottomOffice !== "") {
    if(str_contains($topBottomOffice, 'top') || str_contains($topBottomOffice, 'bottom')) {
        $orderCategory = "";
        
        $limit = explode("-", $topBottomOffice)[1];
        
        if(str_starts_with($topBottomOffice, 'top')) {
            $orderCategory = "DESC";
        } else {
            $orderCategory = "ASC";
        }
        
        $sql .= " ORDER BY ".$category." ".$orderCategory." LIMIT ".$limit;
    }
}

$result = $conn->query($sql);

// Initialize record count
$recordCount = 0;

// Generate the HTML table
if ($result->num_rows > 0) {
    $sums = [
        "Name" => 0,
        "net_target" => 0,
        "net_prop_target" => 0,
        "net_tot" => 0,
        "net_apr_24" => 0,
        "net_may_24" => 0,
        "net_jun_24" => 0,
        "net_jul_24" => 0,
        "net_aug_24" => 0,
        "net_sep_24" => 0,
        "net_oct_24" => 0,
        "net_nov_24" => 0,
        "net_dec_24" => 0,
        "net_jan_24" => 0,
        "net_feb_24" => 0,
        "net_mar_24" => 0,
        "Achievment" => 0,
        "Achievment1" => 0,
        "Remarks" => "--",
    ];

    $addNames = "";
    
    if(!empty($aoname)) {
        if($aoname !== "all_acs") {
            $addNames .= "<th class='left-align' data-backendName='AO_Name'>Account Office</th>";
        }
        $addNames .= "<th class='left-align' data-backendName='Sub_Division'>Sub Division</th>";
        $addNames .= "<th class='left-align' data-backendName='Division'>Division</th>";
    } elseif(!empty($subdivision)) {
        $addNames .= "<th class='left-align' data-backendName='Division'>Division</th>";
    }

    // Record count display
    $recordCount = $result->num_rows;
    echo "<p><strong>$recordCount</strong> records.</p>";
    
    echo "<table border='2'>
    <tr class='sticky-row'> 
        <th class='left-align'  data-backendName='Name'>Office Name</th>".$addNames."
        <th data-backendName='net_target'>Annual Net </br>Target</th>
        <th data-backendName='net_prop_target'>Proportion </br>Target</th>
        <th data-backendName='net_tot'>Total A/cs </br> Opened</th>
        
        <th colspan='3' style='text-align:center;'>1st Quarter</th> <!-- Quarterly Column -->
        
        <th colspan='3' style='text-align:center;'>2nd Quarter</th> <!-- Quarterly Column -->
        <th colspan='3' style='text-align:center;'>3rd Quarter</th> <!-- Quarterly Column -->
        <th colspan='3' style='text-align:center;'>4th Quarter</th> <!-- Quarterly Column -->
        
        <th data-backendName='`%age`'>Annual Target<br /> Achieved</th>
        <th data-backendName='`%age1`'>Proportion Target <br /> Achieved</th>
        <th data-backendName='Remarks'>Remarks</th>
    </tr>
    
    <tr class='sticky-row'>
        <th></th><th></th><th></th><th></th>
        <th>Apr-24</th><th>May-24</th><th>Jun-24</th> <!-- Apr, May, Jun columns under Quarterly -->
        
        <th>Ju-24</th><th>Aug-24 </th><th>Sep-24</th>
        
        
        <th>Oct-24</th><th>Nov-24</th><th>Dec-24</th>
        <th>Jan-24</th><th>Feb-24</th><th>Mar-24</th>
        
        <th></th><th></th>
    </tr>";

    // Loop through the results and generate table rows
    while ($row = $result->fetch_assoc()) {
        if(isset($_GET['searchQuery']) && $_GET['searchQuery'] !== "" && !str_contains(strtolower($row["Name"]), strtolower($_GET['searchQuery']))) {
            continue;
        }

        // Achievement calculations
        $net_target = $row["net_target"];
        $net_prop_target = $row["net_prop_target"];
        $net_tot = $row["net_tot"];

        // Calculate achievement percentage
        $achievment = $net_target != 0 ? number_format(($net_tot / $net_target) * 100, 2, '.', '') : 0;
        $achievment1 = $net_prop_target != 0 ? number_format(($net_tot / $net_prop_target) * 100, 2, '.', '') : 0;

        // Update the sum values
        $sums["net_target"] += $row["net_target"];
        $sums["net_prop_target"] += $row["net_prop_target"];
        $sums["net_tot"] += $row["net_tot"];
        $sums["net_apr_24"] += $row["net_apr_24"];
        $sums["net_may_24"] += $row["net_may_24"];
        $sums["net_jun_24"] += $row["net_jun_24"];
        $sums["net_jul_24"] += $row["net_jul_24"];
        $sums["net_aug_24"] += $row["net_aug_24"];
        $sums["net_sep_24"] += $row["net_sep_24"];
        $sums["net_oct_24"] += $row["net_oct_24"];
        $sums["net_nov_24"] += $row["net_nov_24"];
        $sums["net_dec_24"] += $row["net_dec_24"];
        $sums["net_jan_24"] += $row["net_jan_24"];
        $sums["net_feb_24"] += $row["net_feb_24"];
        $sums["net_mar_24"] += $row["net_mar_24"];
        $sums["Achievment"] += $achievment;
        $sums["Achievment1"] += $achievment1;
        $sums["Remarks"] = $row["Remarks"];

        // Output the row
        echo "<tr>
            <td>".$row["Name"]."</td>";

        if(!empty($aoname)) {
            if($aoname !== "all_acs") {
                echo "<td>".$row["AO_Name"]."</td>";
            }
            echo "<td>".$row["Sub_Division"]."</td>";
            echo "<td>".$row["Division"]."</td>";
        } elseif(!empty($subdivision)) {
            echo "<td>".$row["Division"]."</td>";
        }

        // Output data under the correct headers
        echo "<td>".$row["net_target"]."</td>
            <td>".$row["net_prop_target"]."</td>
            <td>".$row["net_tot"]."</td>
            <td>".$row["net_apr_24"]."</td>
            <td>".$row["net_may_24"]."</td>
            <td>".$row["net_jun_24"]."</td>
            <td>".$row["net_jul_24"]."</td>
            <td>".$row["net_aug_24"]."</td>
            <td>".$row["net_sep_24"]."</td>
            <td>".$row["net_oct_24"]."</td>
            <td>".$row["net_nov_24"]."</td>
            <td>".$row["net_dec_24"]."</td>
            <td>".$row["net_jan_24"]."</td>
            <td>".$row["net_feb_24"]."</td>
            <td>".$row["net_mar_24"]."</td>
            <td>".$achievment." %</td>
            <td>".$achievment1." %</td>
            <td>".$row["Remarks"]."</td>
        </tr>";
    }

    // Output the total row
    $total_achievment = $sums["net_target"] != 0 ? number_format(($sums["net_tot"] / $sums["net_target"]) * 100, 2, '.', '') : 0;
    $total_achievment1 = $sums["net_prop_target"] != 0 ? number_format(($sums["net_tot"] / $sums["net_prop_target"]) * 100, 2, '.', '') : 0;

    // Total row with bold and colored styles
    echo "<tr style='background-color: #f2f2f2;'>
        <td><strong style='font-weight: bold; color: #d9534f;'>Total</strong></td>";

    if(!empty($aoname)) {
        if($aoname !== "all_acs") {
            echo "<td></td>";
        }
        echo "<td></td><td></td>";
    } elseif(!empty($subdivision)) {
        echo "<td></td>";
    }

    // Output the total values with bold and color applied
    echo "<td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_target"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_prop_target"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_tot"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_apr_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_may_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_jun_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_jul_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_aug_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_sep_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_oct_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_nov_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_dec_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_jan_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_feb_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["net_mar_24"]."</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$total_achievment." %</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$total_achievment1." %</strong></td>
        <td><strong style='font-weight: bold; color: #d9534f;'>".$sums["Remarks"]."</strong></td>
    </tr>";
    echo "</table>";
}

   
   
   
   

$conn->close();
?>
