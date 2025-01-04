<?php
include 'connection.php'; // Include the database connection file

// SQL query to retrieve the top three offices (H.O, S.O, B.O combined) in each division under SK Region
$sql = "SELECT Division, Office_Name, Sub_Division, Total_Acs, Office_Type
        FROM (
            SELECT Division, Office_Name, Sub_Division, Total_Acs, Office_Type,
                ROW_NUMBER() OVER(PARTITION BY Division, Office_Type ORDER BY Total_Acs DESC) AS row_num
            FROM posb_karnataka1_24_25
            WHERE Office_Type IN ('H.O', 'S.O', 'B.O')
            AND Region = 'SK Region'  -- Filter by SK Region
        ) AS ranked
        WHERE row_num <= 3
        ORDER BY Division, FIELD(Office_Type, 'H.O', 'S.O', 'B.O'), row_num";

$result = $conn->query($sql);

// Create an array to store Division data and whether it is initially expanded or collapsed
$divisionData = array();

while ($row = $result->fetch_assoc()) {
    $division = $row['Division'];
    $officeType = $row['Office_Type'];
    $officeName = $row['Office_Name'];
    $subDivision = $row['Sub_Division'];
    $totalAccounts = $row['Total_Acs'];

    // Check if the Division exists in the array
    if (!isset($divisionData[$division])) {
        $divisionData[$division] = array(
            'expanded' => false, // Initially collapsed
            'data' => array()
        );
    }

    // Add office data to the Division
    $divisionData[$division]['data'][] = array(
        'officeType' => $officeType,
        'officeName' => $officeName,
        'subDivision' => $subDivision,
        'totalAccounts' => $totalAccounts
    );
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top Offices</title>
   <style>
        /* Add CSS for the toggle buttons */
        .toggle-button {
            cursor: pointer;
            background-color: #f2f2f2;
            border: none;
            text-align: center;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            font-size: 40px; /* Increase the font size */
        }

        /* Add CSS for the division data */
        .division-data {
            display: none;
            padding: 10px;
        }

        /* Add CSS for the division tables */
        .division-table {
            width: 100%;
            border-collapse: collapse;
        }

        .division-table th, .division-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .division-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Adjust column widths */
         .division-table th:nth-child(2),
        .division-table td:nth-child(2),
        .division-table th:nth-child(3),
        .division-table td:nth-child(3) {
            width: 240px; /* Adjust the width as needed for Office Name and Sub Division */
        }
        .division-table th:nth-child(1),
        .division-table td:nth-child(1),
       .division-table th:nth-child(4),
        .division-table td:nth-child(4),
        .division-table th:nth-child(5),
        .division-table td:nth-child(5) {
            width: 40px; /* Adjust the width as needed for Office Type and Position */
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 style='text-align:center;'>Top 3 Head Offices, Sub Offices & Branch Offices in Each Division under SK Region</h2>

    <?php
    // Loop through the division data and create toggle buttons and data tables
    foreach ($divisionData as $division => $data) {
        $expanded = $data['expanded'] ? 'block' : 'none';
        echo "<button class='toggle-button' onclick='toggleDivision(\"$division\")'>$division</button>";
        echo "<div class='division-data' id='$division' style='display: $expanded;'>";
        echo "<table class='division-table'>";
        echo "<tr><th>Office Type</th><th>Office Name</th><th>Sub Division</th><th>Total Accounts</th><th>Position</th></tr>";

        $serialNumber = 1;

        foreach ($data['data'] as $office) {
            $officeType = $office['officeType'];
            $officeName = $office['officeName'];
            $subDivision = $office['subDivision'];
            $totalAccounts = $office['totalAccounts'];
            
            echo "<tr><td>$officeType</td><td>$officeName</td><td>$subDivision</td><td>$totalAccounts</td><td>$serialNumber</td></tr>";
            $serialNumber++;
        }

        echo "</table>";
        echo "</div>";
    }
    ?>

    <script>
        function toggleDivision(division) {
            var x = document.getElementById(division);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</body>
</html>
