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

$sql = ",SUM(Target_2024_25) AS Target_2024_25, SUM(P_Target) AS P_Target, SUM(TOTAL_AC_OPENED) AS TOTAL_AC_OPENED, SUM(SB_AC) AS SB_AC, SUM(RD_AC) AS RD_AC, SUM(TD_AC) AS TD_AC, SUM(SSA_AC) AS SSA_AC,SUM(MSSC_AC) AS MSSC_AC,SUM(PPF_AC) AS PPF_AC, SUM(MIS_AC) AS MIS_AC, SUM(SCSS_AC) AS SCSS_AC, SUM(KVP_AC) AS KVP_AC, SUM(NSC_AC) AS NSC_AC,  (SUM(TOTAL_AC_OPENED)/SUM(Target_2024_25))*100 AS `%age`,(SUM(TOTAL_AC_OPENED)/SUM(P_Target))*100 AS `%age1`, Remarks,AO_Name,Sub_Division,Division FROM posb_karnataka_2024_25_contest WHERE 1";


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

// Generate the HTML table
if ($result->num_rows > 0) {
    $sums = [
        "Name" => 0,
        "Target_2024_25" => 0,
        "P_Target" => 0,
         "TOTAL_AC_OPENED" => 0,
        "SB_AC" => 0,
        "RD_AC" => 0,
        "TD_AC" => 0,
        "SSA_AC" => 0,
        "MSSC_AC" => 0,
        "PPF_AC" => 0,
        "MIS_AC" => 0,
        "SCSS_AC" => 0,
        "KVP_AC" => 0,
        "NSC_AC" => 0,
       
        "Achievment" => 0,
        "Achievment1" => 0,
        "Remarks" => "--",
    ];
    
    $addNames = "";
    
    if(!empty($aoname)) {
   	 if($aoname !== "all_acs") {
    		$addNames .= "<th class='left-align'  data-backendName='AO_Name'>Account Office</th>";
			}
    	$addNames .= "<th class='left-align' data-backendName='Sub_Division'>Sub Division</th>";
    	$addNames .= "<th class='left-align'  data-backendName='Division'>Division</th>";
    } elseif(!empty($subdivision)) {
    	$addNames .= "<th class='left-align' data-backendName='Division'>Division</th>";
    }

    echo "<table border='2'>
    
    
       <tr class='sticky-row'> 
           
            <th class='left-align'  data-backendName='Name'>Office Name</th>".$addNames."
            <th data-backendName='Target_2024_25'>Annual </br>Target</th>
            <th data-backendName='P_Target'>Proportion </br>Target</th>
              <th data-backendName='TOTAL_AC_OPENED'>Total A/cs </br> Opened</th>
            <th data-backendName='SB_AC'> SB A/Cs </th>
            <th data-backendName='RD_AC'> RD A/Cs </th>
            <th data-backendName='TD_AC'>TD A/cs </th>
            <th data-backendName='SSA_AC'>SSA A/cs </th>
            <th data-backendName='MSSC_AC'>MSSC A/cs </th>
            <th data-backendName='PPF_AC'>PPF A/cs </th>
            <th data-backendName='MIS_AC'> MIS A/cs</th>
            <th data-backendName='SCSS_AC'> SCSS A/cs</th>
            <th data-backendName='KVP_AC'>KVP A/cs</th>
             <th data-backendName='NSC_AC'>NSC A/cs</th>
           
            
             <th data-backendName='`%age`'>Annual Target<br /> Achieved</th>
             <th data-backendName='`%age1`'>Proportion Target <br /> Achieved</th>
             <th data-backendName='Remarks'>Remarks</th>  
            
        </tr>";

    while ($row = $result->fetch_assoc()) {
        
        
        
    		if(isset($_GET['searchQuery']) && $_GET['searchQuery'] !== "" && !str_contains(strtolower($row["Name"]), strtolower($_GET['searchQuery']))) {
    			continue;
    		}
    		
    	
    		
    		$achievment = $row['%age'];
    		
    		
    		$achievment = number_format((float)$achievment, 2, '.', '');
    		
    		$achievment1 = $row['%age1'];
    		
    		
    		$achievment1 = number_format((float)$achievment1, 2, '.', '');
    		
    		if(!empty($category) && !empty($topBottomOffice) && !str_contains($topBottomOffice, 'top') && !str_contains($topBottomOffice, 'bottom')) {
    			$number = str_replace("<", "", str_replace(">", "", str_replace("= ", "",$topBottomOffice)));
    			$fieldName = str_replace("`", '', $category);
    			
    			if(!str_contains($topBottomOffice, ">")) {
    				if(!str_contains($topBottomOffice, "<")) {
	    				if(floatval($row[$fieldName]) != floatval($number)) {
	    					continue;
	    				}
	    			} else {
	    				if(floatval($row[$fieldName]) > floatval($number)) {
	    					continue;
	    				}
	    			}
    			} else {
	    				if(floatval($row[$fieldName]) < floatval($number)) {
	    					continue;
	    				}
	    			}
    		}
    		
        echo "<tr>";

        echo "<td>{$row["Name"]}</td>";
        if(!empty($aoname)) {
        	if($aoname !== "all_acs") {
        	    
        	   	echo "<td class='left-align'>{$row["AO_Name"]}</td>";
        	}
        	echo "<td class='left-align'>{$row["Sub_Division"]}</td>";
		    	echo "<td class='left-align'>{$row["Division"]}</td>";
		    } elseif(!empty($subdivision)) {
		    	echo "<td class='left-align' >{$row["Division"]}</td>";
		    }
		    
		    
		    
		    
		    
        echo "<td>{$row["Target_2024_25"]}</td>";
        echo "<td>{$row["P_Target"]}</td>";
          echo "<td>{$row["TOTAL_AC_OPENED"]}</td>";
        echo "<td>{$row["SB_AC"]}</td>";
        echo "<td>{$row["RD_AC"]}</td>";
        echo "<td>{$row["TD_AC"]}</td>";
        echo "<td>{$row["SSA_AC"]}</td>";
        echo "<td>{$row["MSSC_AC"]}</td>";
        echo "<td>{$row["PPF_AC"]}</td>";
        echo "<td>{$row["MIS_AC"]}</td>";
        echo "<td>{$row["SCSS_AC"]}</td>";
        echo "<td>{$row["KVP_AC"]}</td>";
        echo "<td>{$row["NSC_AC"]}</td>";
      
       
        echo "<td>{$achievment}%</td>";
        echo "<td>{$achievment1}%</td>";

        echo "<td>{$row["Remarks"]}</td>";

        echo "</tr>";

       
       // Update the sums
        if (is_numeric($row["Name"])) {
            $sums["Name"] += (int) $row["Name"];
        }
        if (is_numeric($row["AO_Name"])) {
            $sums["AO_Name"] += (int) $row["AO_Name"];
        }
        if (is_numeric($row["Sub_Division"])) {
            $sums["Sub_Division"] += (int) $row["Sub_Division"];
        }
        if (is_numeric($row["Division"])) {
            $sums["Division"] += (int) $row["Division"];
        }
        if (is_numeric($row["Name"])) {
            $sums["Name"] += (int) $row["Name"];
        }
        if (is_numeric($row["Target_2024_25"])) {
            $sums["Target_2024_25"] += (int) $row["Target_2024_25"];
        }
        if (is_numeric($row["P_Target"])) {
            $sums["P_Target"] += (int) $row["P_Target"];
        }
        if (is_numeric($row["TOTAL_AC_OPENED"])) {
            $sums["TOTAL_AC_OPENED"] += (int) $row["TOTAL_AC_OPENED"];
        }
        
        if (is_numeric($row["SB_AC"])) {
            $sums["SB_AC"] += (int) $row["SB_AC"];
        }
        if (is_numeric($row["RD_AC"])) {
            $sums["RD_AC"] += (int) $row["RD_AC"];
        }
        if (is_numeric($row["TD_AC"])) {
            $sums["TD_AC"] += (int) $row["TD_AC"];
        }

        if (is_numeric($row["SSA_AC"])) {
            $sums["SSA_AC"] += (int) $row["SSA_AC"];
        }
        if (is_numeric($row["MSSC_AC"])) {
            $sums["MSSC_AC"] += (int) $row["MSSC_AC"];
        }
        if (is_numeric($row["PPF_AC"])) {
            $sums["PPF_AC"] += (int) $row["PPF_AC"];
        }
        if (is_numeric($row["MIS_AC"])) {
            $sums["MIS_AC"] += (int) $row["MIS_AC"];
        }
        if (is_numeric($row["SCSS_AC"])) {
            $sums["SCSS_AC"] += (int) $row["SCSS_AC"];
        }
        if (is_numeric($row["KVP_AC"])) {
            $sums["KVP_AC"] += (int) $row["KVP_AC"];
        }
        if (is_numeric($row["NSC_AC"])) {
            $sums["NSC_AC"] += (int) $row["NSC_AC"];
        }
        
        
       
        if (is_numeric($achievment)) {
            $sums["Achievment"] = 0;
		    		if($sums["Target_2024_25"]) {
		    			$sums["Achievment"] = $sums["TOTAL_AC_OPENED"] / $sums["Target_2024_25"];
		    		}
		    		$sums["Achievment"] *= 100;
		    		
		    		
		    		$sums["Achievment"] = number_format((float)$sums["Achievment"], 2, '.', '');
        }
        
        if (is_numeric($achievment1)) {
            $sums["Achievment1"] = 0;
		    		if($sums["P_Target"]) {
		    			$sums["Achievment1"] = $sums["TOTAL_AC_OPENED"] / $sums["P_Target"];
		    		}
		    		$sums["Achievment1"] *= 100;
		    		
		    		
		    		$sums["Achievment1"] = number_format((float)$sums["Achievment1"], 2, '.', '');
        }
    }

    // Calculate the total count for the Office_Name column
    $officeNameCount = $result->num_rows;

    // Display the sum row
    echo "<tr>";
    foreach ($sums as $column => $sum) {
        //if ($column == "Name") {
        //echo "<td style='text-align: center; font-weight: bold; font-size:22px; color:#b22222' rowspan='2'>Total</td>"; // Display "Total" for Name

        //}

        if ($column == "Name") {
            echo "<td style='text-align: center; font-weight: bold; color:#b22222'>Total:</td>"; // Display "Nos of Office" for Office_Name
            if(!empty($aoname)) {
            	if($aoname !== "all_acs") {
            		echo "<td></td>";
            	}
            	echo "<td></td>";
            	echo "<td></td>";
            } elseif(!empty($subdivision)) {
            	echo "<td></td>";
            }
        } elseif($column === "Achievment" || $column === "Achievment1") {
        	echo "<td class='total-cell'>{$sum}%</td>";
        } else {
            echo "<td class='total-cell'>{$sum}</td>";
        }
    }

    // Display the sum row
    // echo "<tr>";
    //foreach ($sums as $column => $sum) {
    // Leave Office_Name and Sub_Division columns blank
    // if ($column == "Ser" || $column == "Office_Name" || $column == "AO_Name" || $column == "Sub_Division" || $column == "Division" || $column == "Name" ) {
    //   echo "<td></td>";
    // } else {
    //    echo "<td class='total-cell'>   {$sum}</td>"; // Apply class to total cells
    //  }
    //  }

    echo "</tr>";

    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>
