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
            $username = 'u562946175_drive';
            $password = 'Drive@2024';
            $dbname = 'u562946175_drive';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = ",SUM(posb_target) AS posb_target, SUM(posb_prop_target) AS posb_prop_target, SUM(posb_Ac) AS posb_Ac, SUM(A_c_Opened) AS A_c_Opened, SUM(shortfall) AS shortfall, SUM(mssc_tot) AS mssc_tot, SUM(a1) AS a1, SUM(a2) AS a2, SUM(a3) AS a3, SUM(a4) AS a4, SUM(a5) AS a5, SUM(a6) AS a6, SUM(a7) AS a7, SUM(a8) AS a8, SUM(a9) AS a9, SUM(a10) AS a10, SUM(a11) AS a11, SUM(a12) AS a12, SUM(a13) AS a13, SUM(a14) AS a14, SUM(a15) AS a15, SUM(a16) AS a16, SUM(a17) AS a17, SUM(a18) AS a18, SUM(a19) AS a19, SUM(a20) AS a20, SUM(a21) AS a21, SUM(a22) AS a22, SUM(a23) AS a23, SUM(a24) AS a24, SUM(a25) AS a25, SUM(a26) AS a26, SUM(a27) AS a27, SUM(a28) AS a28, SUM(a29) AS a29, SUM(a30) AS a30, (SUM(A_c_Opened)/SUM(posb_target))*100 AS `%age`,(SUM(A_c_Opened)/SUM(posb_prop_target))*100 AS `%age1`,AO_Name,Sub_Division,Division FROM 2025_drive WHERE 1";


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
        "posb_Ac" => 0,
         "mssc_tot" => 0,
         "A_c_Opened" => 0,
          "shortfall" => 0,
           "Achievment" => 0,
           
              "Achievment1" => 0,
                
             
        "a1" => 0,
        "a2" => 0,
       /* "a3" => 0,*/
        "a4" => 0,
        "a5" => 0,
        "a6" => 0,
         "a7" => 0,
        "a8" => 0,
        "a9" => 0,
       /* "a10" => 0,*/
        
        "a11" => 0,
         "a12" => 0,
         "a13" => 0,
         "a14" => 0,
         /* "a15" => 0,*/
         "a16" => 0,
         /*"a17" => 0,*/
        "a18" => 0,
        "a19" => 0,
         "a20" => 0,
        "a21" => 0,
        "a22" => 0,
        "a23" => 0,
        /* "a24" => 0, */
       "a25" => 0,
         "a26" => 0,
        "a27" => 0,
        "a28" => 0,
        "a29" => 0,
        "a30" => 0,   
      
      
    
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
            <th data-backendName='posb_target'>Drive Period </br>Target</th>
           <th data-backendName='posb_prop_target'>Proportion </br>Target</th>
             <th data-backendName='`posb_Ac`'>POSB A/Cs <br /> Opened </th>
             <th data-backendName='`mssc_tot`'>MSSC A/Cs <br /> Opened </th>
            <th data-backendName='A_c_Opened'>Total A/cs </br> Opened</th>
            <th data-backendName='shortfall'>Shortfall</th>
             <th data-backendName='`%age`'> Drive Target<br /> Achieved</th>
               
                        <th data-backendName='`%age1`'>Proportion Target <br /> Achieved</th>
                        
                       
                
            <th data-backendName='a1'> 1 </th>
            <th data-backendName='a2'> 2 </th>
              <!-- <th data-backendName='a3'>3 </th>-->
            <th data-backendName='a4'>4 </th>
            <th data-backendName='a5'> 5</th>
            
            
           <th data-backendName='a6'>6</th>
               <th data-backendName='a7'>7</th>
                                                      
                                                      <th data-backendName='a8'>8 </th>
                                                        <th data-backendName='a9'>9</th>
                                                      <!--   <th data-backendName='a10'>10</th>-->
                                                        <th data-backendName='a11'>11</th>
                                                      <th data-backendName='a12'>12</th>
                                                           <th data-backendName='a13'>13</th>
                                                        <th data-backendName='a14'>14</th>
                                                        <!--   <th data-backendName='a15'>15</th>-->
                                                        <th data-backendName='a16'>16</th>
                                                        <!--  <th data-backendName='a17'>17</th>-->
                                                        <th data-backendName='a18'>18</th>
                                                        <th data-backendName='a19'>19</th>
                                                         <th data-backendName='a20'>20</th>
                                                        <th data-backendName='a21'>21</th>
                                                        <th data-backendName='a22'>22</th>
                                                        <th data-backendName='a23'>23</th>
                                                        <!-- <th data-backendName='a24'>24</th>-->
                                                       <th data-backendName='a25'>25</th>
                                                          <th data-backendName='a26'>26</th>
                                                        <th data-backendName='a27'>27</th>
                                                        <th data-backendName='a28'>28</th>
                                                        <th data-backendName='a29'>29</th>
                                                        <th data-backendName='a30'>30</th>
            
     
           
            
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
          echo "<td>{$row["posb_Ac"]}</td>";
            echo "<td>{$row["mssc_tot"]}</td>";
          echo "<td>{$row["A_c_Opened"]}</td>";
           echo "<td>{$row["shortfall"]}</td>";
               echo "<td>{$achievment}%</td>";
             
                 echo "<td>{$achievment1}%</td>";
                   
              
                 
        echo "<td>{$row["a1"]}</td>";
        echo "<td>{$row["a2"]}</td>";
       /* echo "<td>{$row["a3"]}</td>";*/
       
        echo "<td>{$row["a4"]}</td>";
        echo "<td>{$row["a5"]}</td>";
        echo "<td>{$row["a6"]}</td>";
         echo "<td>{$row["a7"]}</td>";
        echo "<td>{$row["a8"]}</td>";
        echo "<td>{$row["a9"]}</td>";
      /*  echo "<td>{$row["a10"]}</td>";*/
      echo "<td>{$row["a11"]}</td>";
      
        echo "<td>{$row["a12"]}</td>";
          echo "<td>{$row["a13"]}</td>";
      echo "<td>{$row["a14"]}</td>";
       /* echo "<td>{$row["a15"]}</td>";*/
         echo "<td>{$row["a16"]}</td>";
       /*  echo "<td>{$row["a17"]}</td>";*/
        echo "<td>{$row["a18"]}</td>";
        echo "<td>{$row["a19"]}</td>";
      echo "<td>{$row["a20"]}</td>";
        echo "<td>{$row["a21"]}</td>";
        echo "<td>{$row["a22"]}</td>";
        echo "<td>{$row["a23"]}</td>";
          /* echo "<td>{$row["a24"]}</td>";*/
         echo "<td>{$row["a25"]}</td>";
          echo "<td>{$row["a26"]}</td>";
        echo "<td>{$row["a27"]}</td>";
        echo "<td>{$row["a28"]}</td>";
        echo "<td>{$row["a29"]}</td>";
        echo "<td>{$row["a30"]}</td>";
   
      

      

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
        
        
        
        if (is_numeric($row["posb_Ac"])) {
            $sums["posb_Ac"] += (int) $row["posb_Ac"];
        }
        
        
        
        
        if (is_numeric($row["mssc_tot"])) {
            $sums["mssc_tot"] += (int) $row["mssc_tot"];
        }
        
        if (is_numeric($row["A_c_Opened"])) {
            $sums["A_c_Opened"] += (int) $row["A_c_Opened"];
        }
         if (is_numeric($row["shortfall"])) {
            $sums["shortfall"] += (int) $row["shortfall"];
        }
         
        
        
        if (is_numeric($row["a1"])) {
            $sums["a1"] += (int) $row["a1"];
        }
        if (is_numeric($row["a2"])) {
            $sums["a2"] += (int) $row["a2"];
        }
      /*  if (is_numeric($row["a3"])) {
            $sums["a3"] += (int) $row["a3"];
        }*/

       
        if (is_numeric($row["a4"])) {
            $sums["a4"] += (int) $row["a4"];
        }
        if (is_numeric($row["a5"])) {
            $sums["a5"] += (int) $row["a5"];
        }
       
       
       if (is_numeric($row["a6"])) {
         $sums["a6"] += (int) $row["a6"];
     }
           if (is_numeric($row["a7"])) {
            $sums["a7"] += (int) $row["a7"];
        }
        if (is_numeric($row["a8"])) {
            $sums["a8"] += (int) $row["a8"];
        }
        if (is_numeric($row["a9"])) {
            $sums["a9"] += (int) $row["a9"];
        }
        /*if (is_numeric($row["a10"])) {
            $sums["a10"] += (int) $row["a10"];
        }*/
         if (is_numeric($row["a11"])) {
            $sums["a11"] += (int) $row["a11"];
        }
    
       
       if (is_numeric($row["a12"])) {
            $sums["a12"] += (int) $row["a12"];
        }
        
            if (is_numeric($row["a13"])) {
            $sums["a13"] += (int) $row["a13"];
        }
        
          if (is_numeric($row["a14"])) {
            $sums["a14"] += (int) $row["a14"];
        }
        
         /*  if (is_numeric($row["a15"])) {
            $sums["a15"] += (int) $row["a15"];
        }*/
        
        if (is_numeric($row["a16"])) {
            $sums["a16"] += (int) $row["a16"];
        }
        
      /* if (is_numeric($row["a17"])) {
            $sums["a17"] += (int) $row["a17"];
        }*/


        if (is_numeric($row["a18"])) {
            $sums["a18"] += (int) $row["a18"];
        }

        if (is_numeric($row["a19"])) {
            $sums["a19"] += (int) $row["a19"];
        }

         if (is_numeric($row["a20"])) {
            $sums["a20"] += (int) $row["a20"];
        }

        if (is_numeric($row["a21"])) {
            $sums["a21"] += (int) $row["a21"];
        }

        if (is_numeric($row["a22"])) {
            $sums["a22"] += (int) $row["a22"];
        }

        if (is_numeric($row["a23"])) {
            $sums["a23"] += (int) $row["a23"];
        }

       /*  if (is_numeric($row["a24"])) {
            $sums["a24"] += (int) $row["a24"];
        }*/

        if (is_numeric($row["a25"])) {
            $sums["a25"] += (int) $row["a25"];
        }

         if (is_numeric($row["a26"])) {
            $sums["a26"] += (int) $row["a26"];
        }

        if (is_numeric($row["a27"])) {
            $sums["a27"] += (int) $row["a27"];
        }

        if (is_numeric($row["a28"])) {
            $sums["a28"] += (int) $row["a28"];
        }

        if (is_numeric($row["a29"])) {
            $sums["a29"] += (int) $row["a29"];
        }

        if (is_numeric($row["a30"])) {
            $sums["a30"] += (int) $row["a30"];
        }






       
        if (is_numeric($achievment)) {
            $sums["Achievment"] = 0;
		    		if($sums["posb_target"]) {
		    			$sums["Achievment"] = $sums["A_c_Opened"] / $sums["posb_target"];
		    		}
		    		$sums["Achievment"] *= 100;
		    		
		    		
		    		$sums["Achievment"] = number_format((float)$sums["Achievment"], 2, '.', '');
        }
        
        if (is_numeric($achievment1)) {
            $sums["Achievment1"] = 0;
		    		if($sums["posb_prop_target"]) {
		    			$sums["Achievment1"] = $sums["A_c_Opened"] / $sums["posb_prop_target"];
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
