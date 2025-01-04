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

$sql = ",SUM(posb_target) AS posb_target, SUM(posb_prop_target) AS posb_prop_target, SUM(tot_24) AS tot_24, SUM(apr_24) AS apr_24, SUM(may_24) AS may_24, SUM(jun_24) AS jun_24, SUM(oct_24) AS oct_24,SUM(nov_24) AS nov_24,SUM(jul_24) AS jul_24, SUM(aug_24) AS aug_24, SUM(sep_24) AS sep_24, SUM(dec_24) AS dec_24, SUM(jan_24) AS jan_24, SUM(feb_24) AS feb_24, SUM(mar_24) AS mar_24,  (SUM(tot_24)/SUM(posb_target))*100 AS `%age`,(SUM(tot_24)/SUM(posb_prop_target))*100 AS `%age1`, Remarks,AO_Name,Sub_Division,Division FROM posb_karnataka1_24_25 WHERE 1";


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
        "posb_target" => 0,
        "posb_prop_target" => 0,
         "tot_24" => 0,
        "apr_24" => 0,
        "may_24" => 0,
        "jun_24" => 0,
        "jul_24" => 0,
        "aug_24" => 0,
        "sep_24" => 0,
        "oct_24" => 0,
        "nov_24" => 0,
         "dec_24" => 0,
        // "jan_24" => 0,
        // "feb_24" => 0,
        //  "mar_24" => 0,
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
            <th data-backendName='posb_target'>Annual </br>Target</th>
            <th data-backendName='posb_prop_target'>Proportion </br>Target</th>
            <th data-backendName='tot_24'>Total A/cs </br> Opened</th>
            <th data-backendName='apr_24'> Apr-24 </th>
            <th data-backendName='may_24'> May-24 </th>
            <th data-backendName='jun_24'>Jun-24 </th>
            <th data-backendName='jul_24'>Jul-24 </th>
            <th data-backendName='aug_24'> Aug-24</th>
            <th data-backendName='sep_24'>Sep-24</th>
            <th data-backendName='oct_24'>Oct-24</th>
                                                      
                                                       <th data-backendName='nov_24'>Nov-24 </th>
                                                         <th data-backendName='dec_24'>Dec-24</th>
                                                        <!--  <th data-backendName='jan_24'>Jan-24</th>
                                                        <th data-backendName='feb_24'>Feb-24</th>
                                                         <th data-backendName='mar_24'>Mar-24</th>-->
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
		    
		    
		    
		    
		    
        echo "<td>{$row["posb_target"]}</td>";
        echo "<td>{$row["posb_prop_target"]}</td>";
          echo "<td>{$row["tot_24"]}</td>";
        echo "<td>{$row["apr_24"]}</td>";
        echo "<td>{$row["may_24"]}</td>";
        echo "<td>{$row["jun_24"]}</td>";
       
        echo "<td>{$row["jul_24"]}</td>";
        echo "<td>{$row["aug_24"]}</td>";
        echo "<td>{$row["sep_24"]}</td>";
        echo "<td>{$row["oct_24"]}</td>";
      echo "<td>{$row["nov_24"]}</td>";
     echo "<td>{$row["dec_24"]}</td>";
    //     echo "<td>{$row["jan_24"]}</td>";
    //   echo "<td>{$row["feb_24"]}</td>";
    //     echo "<td>{$row["mar_24"]}</td>";
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
        if (is_numeric($row["posb_target"])) {
            $sums["posb_target"] += (int) $row["posb_target"];
        }
        if (is_numeric($row["posb_prop_target"])) {
            $sums["posb_prop_target"] += (int) $row["posb_prop_target"];
        }
        if (is_numeric($row["tot_24"])) {
            $sums["tot_24"] += (int) $row["tot_24"];
        }
        
        if (is_numeric($row["apr_24"])) {
            $sums["apr_24"] += (int) $row["apr_24"];
        }
        if (is_numeric($row["may_24"])) {
            $sums["may_24"] += (int) $row["may_24"];
        }
        if (is_numeric($row["jun_24"])) {
            $sums["jun_24"] += (int) $row["jun_24"];
        }

       
        if (is_numeric($row["jul_24"])) {
            $sums["jul_24"] += (int) $row["jul_24"];
        }
        if (is_numeric($row["aug_24"])) {
            $sums["aug_24"] += (int) $row["aug_24"];
        }
        if (is_numeric($row["sep_24"])) {
         $sums["sep_24"] += (int) $row["sep_24"];
     }
         if (is_numeric($row["oct_24"])) {
            $sums["oct_24"] += (int) $row["oct_24"];
        }
         if (is_numeric($row["nov_24"])) {
             $sums["nov_24"] += (int) $row["nov_24"];
       }
        if (is_numeric($row["dec_24"])) {
            $sums["dec_24"] += (int) $row["dec_24"];
        }
        // if (is_numeric($row["jan_24"])) {
        //     $sums["jan_24"] += (int) $row["jan_24"];
        // }
        //  if (is_numeric($row["feb_24"])) {
        //     $sums["feb_24"] += (int) $row["feb_24"];
        // }
    
        //  if (is_numeric($row["mar_24"])) {
        //     $sums["mar_24"] += (int) $row["mar_24"];
        // }
       
        if (is_numeric($achievment)) {
            $sums["Achievment"] = 0;
		    		if($sums["posb_target"]) {
		    			$sums["Achievment"] = $sums["tot_24"] / $sums["posb_target"];
		    		}
		    		$sums["Achievment"] *= 100;
		    		
		    		
		    		$sums["Achievment"] = number_format((float)$sums["Achievment"], 2, '.', '');
        }
        
        if (is_numeric($achievment1)) {
            $sums["Achievment1"] = 0;
		    		if($sums["posb_prop_target"]) {
		    			$sums["Achievment1"] = $sums["tot_24"] / $sums["posb_prop_target"];
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
