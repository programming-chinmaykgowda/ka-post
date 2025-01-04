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
        // "net_jan_24" => 0,
        // "net_feb_24" => 0,
        //  "net_mar_24" => 0,
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
            <th data-backendName='net_target'>Annual Net </br>Target</th>
            <th data-backendName='net_prop_target'>Proportion </br>Target</th>
            <th data-backendName='net_tot'>Total Net A/cs </br> Opened</th>
            <th data-backendName='net_apr_24'> Apr-24 </th>
            <th data-backendName='net_may_24'> May-24 </th>
            <th data-backendName='net_jun_24'>Jun-24 </th>
            <th data-backendName='net_jul_24'>Jul-24 </th>
            <th data-backendName='net_aug_24'> Aug-24</th>
            <th data-backendName='net_sep_24'>Sep-24</th>
            <th data-backendName='net_oct_24'>Oct-24</th>
                                                      
                                                        <th data-backendName='net_nov_24'>Nov-24 </th>
                                                        <th data-backendName='net_dec_24'>Dec-24</th>
                                                       <!--   <th data-backendName='net_jan_24'>Jan-24</th>
                                                        <th data-backendName='net_feb_24'>Feb-24</th>
                                                         <th data-backendName='net_mar_24'>Mar-24</th>-->
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
		    
		    
		    
		    
		    
        echo "<td>{$row["net_target"]}</td>";
        echo "<td>{$row["net_prop_target"]}</td>";
          echo "<td>{$row["net_tot"]}</td>";
        echo "<td>{$row["net_apr_24"]}</td>";
        echo "<td>{$row["net_may_24"]}</td>";
        echo "<td>{$row["net_jun_24"]}</td>";
       
        echo "<td>{$row["net_jul_24"]}</td>";
        echo "<td>{$row["net_aug_24"]}</td>";
        echo "<td>{$row["net_sep_24"]}</td>";
        echo "<td>{$row["net_oct_24"]}</td>";
        echo "<td>{$row["net_nov_24"]}</td>";
      echo "<td>{$row["net_dec_24"]}</td>";
    //     echo "<td>{$row["net_jan_24"]}</td>";
    //   echo "<td>{$row["net_feb_24"]}</td>";
    //     echo "<td>{$row["net_mar_24"]}</td>";
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
        if (is_numeric($row["net_target"])) {
            $sums["net_target"] += (int) $row["net_target"];
        }
        if (is_numeric($row["net_prop_target"])) {
            $sums["net_prop_target"] += (int) $row["net_prop_target"];
        }
        if (is_numeric($row["net_tot"])) {
            $sums["net_tot"] += (int) $row["net_tot"];
        }
        
        if (is_numeric($row["net_apr_24"])) {
            $sums["net_apr_24"] += (int) $row["net_apr_24"];
        }
        if (is_numeric($row["net_may_24"])) {
            $sums["net_may_24"] += (int) $row["net_may_24"];
        }
        if (is_numeric($row["net_jun_24"])) {
            $sums["net_jun_24"] += (int) $row["net_jun_24"];
        }

       
        if (is_numeric($row["net_jul_24"])) {
            $sums["net_jul_24"] += (int) $row["net_jul_24"];
        }
        if (is_numeric($row["net_aug_24"])) {
            $sums["net_aug_24"] += (int) $row["net_aug_24"];
        }
        if (is_numeric($row["net_sep_24"])) {
         $sums["net_sep_24"] += (int) $row["net_sep_24"];
     }
         if (is_numeric($row["net_oct_24"])) {
            $sums["net_oct_24"] += (int) $row["net_oct_24"];
        }
        if (is_numeric($row["net_nov_24"])) {
            $sums["net_nov_24"] += (int) $row["net_nov_24"];
        }
        if (is_numeric($row["net_dec_24"])) {
             $sums["net_dec_24"] += (int) $row["net_dec_24"];
         }
        // if (is_numeric($row["net_jan_24"])) {
        //     $sums["net_jan_24"] += (int) $row["net_jan_24"];
        // }
        //  if (is_numeric($row["net_feb_24"])) {
        //     $sums["net_feb_24"] += (int) $row["net_feb_24"];
        // }
    
        //  if (is_numeric($row["net_mar_24"])) {
        //     $sums["net_mar_24"] += (int) $row["net_mar_24"];
        // }
       
        if (is_numeric($achievment)) {
            $sums["Achievment"] = 0;
		    		if($sums["net_target"]) {
		    			$sums["Achievment"] = $sums["net_tot"] / $sums["net_target"];
		    		}
		    		$sums["Achievment"] *= 100;
		    		
		    		
		    		$sums["Achievment"] = number_format((float)$sums["Achievment"], 2, '.', '');
        }
        
        if (is_numeric($achievment1)) {
            $sums["Achievment1"] = 0;
		    		if($sums["net_prop_target"]) {
		    			$sums["Achievment1"] = $sums["net_tot"] / $sums["net_prop_target"];
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
