<?php 
             $servername = 'localhost';
            $username = 'u562946175_kapost';
            $password = 'Kanthu@1982';
            $dbname = 'u562946175_kapost';


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posb_karnataka1_24_25";

if(isset($_GET['fetchBy']) && $_GET['fetchBy'] !== 'all') {
	$sql .= " WHERE Office_Type='".$_GET['fetchBy']."'";
}


$result = $conn->query($sql);

$data = [];

$counts = ["region" => [], "division" => [], "subdivision" => [], "ao" => [], "office" => [], "total" => ["0" => 0, ">0<26" => 0, ">25<51" => 0, ">50<101" => 0, ">100<201" => 0, ">200<501" => 0, ">500<1001" => 0, ">1000<2001" => 0, ">2000<5001" => 0, ">5000" => 0, "total" => 0]];
$idNameMapping = [];

while ($row = $result->fetch_assoc()) {
	$counts["total"]["total"] += 1;
	if(isset($counts["region"][$row["Region_ID"]]["total"])) {
		$counts["region"][$row["Region_ID"]]["total"] += 1;
	} else {
		$counts["region"][$row["Region_ID"]]["total"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">0<26"]) && $row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["region"][$row["Region_ID"]][">0<26"] += 1;
		
			$counts["total"][">0<26"] += 1;
		
			

	} elseif($row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["total"][">0<26"] += 1;
		$counts["region"][$row["Region_ID"]][">0<26"] = 1;
	}
	
		
	if(isset($counts["region"][$row["Region_ID"]]["0"]) && $row["Total_Acs"] == 0) {
		$counts["region"][$row["Region_ID"]]["0"] += 1;
		
			$counts["total"]["0"] += 1;
		
			

	} elseif($row["Total_Acs"] == 0) {
		$counts["total"]["0"] += 1;
		$counts["region"][$row["Region_ID"]]["0"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">25<51"]) && $row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["region"][$row["Region_ID"]][">25<51"] += 1;
		
			$counts["total"][">25<51"] += 1;
		
			

	} elseif($row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["total"][">25<51"] += 1;
		$counts["region"][$row["Region_ID"]][">25<51"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">50<101"]) && $row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["region"][$row["Region_ID"]][">50<101"] += 1;
		
			$counts["total"][">50<101"] += 1;
		
			

	} elseif($row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["total"][">50<101"] += 1;
		$counts["region"][$row["Region_ID"]][">50<101"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">100<201"]) && $row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["region"][$row["Region_ID"]][">100<201"] += 1;
		
			$counts["total"][">100<201"] += 1;
		
			

	} elseif($row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["total"][">100<201"] += 1;
		$counts["region"][$row["Region_ID"]][">100<201"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">200<501"]) && $row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["region"][$row["Region_ID"]][">200<501"] += 1;
		
			$counts["total"][">200<501"] += 1;
		
			

	} elseif($row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["total"][">200<501"] += 1;
		$counts["region"][$row["Region_ID"]][">200<501"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">500<1001"]) && $row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["region"][$row["Region_ID"]][">500<1001"] += 1;
		
			$counts["total"][">500<1001"] += 1;
		
			

	} elseif($row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["total"][">500<1001"] += 1;
		$counts["region"][$row["Region_ID"]][">500<1001"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">1000<2001"]) && $row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["region"][$row["Region_ID"]][">1000<2001"] += 1;
		
			$counts["total"][">1000<2001"] += 1;
		
			

	} elseif($row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["total"][">1000<2001"] += 1;
		$counts["region"][$row["Region_ID"]][">1000<2001"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">2000<5001"]) && $row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["region"][$row["Region_ID"]][">2000<5001"] += 1;
		
		$counts["total"][">2000<5001"] += 1;
		
			

	} elseif($row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["total"][">2000<5001"] += 1;
		$counts["region"][$row["Region_ID"]][">2000<5001"] = 1;
	}
	
	if(isset($counts["region"][$row["Region_ID"]][">5000"]) && $row["Total_Acs"] > 5000) {
		$counts["region"][$row["Region_ID"]][">5000"] += 1;
		
			$counts["total"][">5000"] += 1;
		
			

	} elseif($row["Total_Acs"] > 5000) {
		$counts["total"][">5000"] += 1;
		$counts["region"][$row["Region_ID"]][">5000"] = 1;
	}
	
	
	if(isset($counts["division"][$row["Division_ID"]]["total"])) {
		$counts["division"][$row["Division_ID"]]["total"] += 1;
	} else {
		$counts["division"][$row["Division_ID"]]["total"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">0<26"]) && $row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["division"][$row["Division_ID"]][">0<26"] += 1;
	} elseif($row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["division"][$row["Division_ID"]][">0<26"] = 1;
	}
	
		
	if(isset($counts["division"][$row["Division_ID"]]["0"]) && $row["Total_Acs"] == 0) {
		$counts["division"][$row["Division_ID"]]["0"] += 1;
	} elseif($row["Total_Acs"] == 0) {
		$counts["division"][$row["Division_ID"]]["0"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">25<51"]) && $row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["division"][$row["Division_ID"]][">25<51"] += 1;
	} elseif($row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["division"][$row["Division_ID"]][">25<51"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">50<101"]) && $row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["division"][$row["Division_ID"]][">50<101"] += 1;
	} elseif($row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["division"][$row["Division_ID"]][">50<101"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">100<201"]) && $row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["division"][$row["Division_ID"]][">100<201"] += 1;
	} elseif($row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["division"][$row["Division_ID"]][">100<201"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">200<501"]) && $row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["division"][$row["Division_ID"]][">200<501"] += 1;
	} elseif($row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["division"][$row["Division_ID"]][">200<501"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">500<1001"]) && $row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["division"][$row["Division_ID"]][">500<1001"] += 1;
	} elseif($row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["division"][$row["Division_ID"]][">500<1001"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">1000<2001"]) && $row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["division"][$row["Division_ID"]][">1000<2001"] += 1;
	} elseif($row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["division"][$row["Division_ID"]][">1000<2001"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">2000<5001"]) && $row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["division"][$row["Division_ID"]][">2000<5001"] += 1;
	} elseif($row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["division"][$row["Division_ID"]][">2000<5001"] = 1;
	}
	
	if(isset($counts["division"][$row["Division_ID"]][">5000"]) && $row["Total_Acs"] > 5000) {
		$counts["division"][$row["Division_ID"]][">5000"] += 1;
	} elseif($row["Total_Acs"] > 5000) {
		$counts["division"][$row["Division_ID"]][">5000"] = 1;
	}
	
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]]["total"])) {
		$counts["subdivision"][$row["Sub_Division_ID"]]["total"] += 1;
	} else {
		$counts["subdivision"][$row["Sub_Division_ID"]]["total"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">0<26"]) && $row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">0<26"] += 1;
	} elseif($row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">0<26"] = 1;
	}
	
		
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]]["0"]) && $row["Total_Acs"] == 0) {
		$counts["subdivision"][$row["Sub_Division_ID"]]["0"] += 1;
	} elseif($row["Total_Acs"] == 0) {
		$counts["subdivision"][$row["Sub_Division_ID"]]["0"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">25<51"]) && $row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">25<51"] += 1;
	} elseif($row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">25<51"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">50<101"]) && $row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">50<101"] += 1;
	} elseif($row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">50<101"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">100<201"]) && $row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">100<201"] += 1;
	} elseif($row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">100<201"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">200<501"]) && $row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">200<501"] += 1;
	} elseif($row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">200<501"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">500<1001"]) && $row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">500<1001"] += 1;
	} elseif($row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">500<1001"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">1000<2001"]) && $row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">1000<2001"] += 1;
	} elseif($row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">1000<2001"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">2000<5001"]) && $row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">2000<5001"] += 1;
	} elseif($row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">2000<5001"] = 1;
	}
	
	if(isset($counts["subdivision"][$row["Sub_Division_ID"]][">5000"]) && $row["Total_Acs"] > 5000) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">5000"] += 1;
	} elseif($row["Total_Acs"] > 5000) {
		$counts["subdivision"][$row["Sub_Division_ID"]][">5000"] = 1;
	}
	
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]]["total"])) {
		$counts["ao"][$row["AO_Facility_ID"]]["total"] += 1;
	} else {
		$counts["ao"][$row["AO_Facility_ID"]]["total"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">0<26"]) && $row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["ao"][$row["AO_Facility_ID"]][">0<26"] += 1;
	} elseif($row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["ao"][$row["AO_Facility_ID"]][">0<26"] = 1;
	}
	
		
	if(isset($counts["ao"][$row["AO_Facility_ID"]]["0"]) && $row["Total_Acs"] == 0) {
		$counts["ao"][$row["AO_Facility_ID"]]["0"] += 1;
	} elseif($row["Total_Acs"] == 0) {
		$counts["ao"][$row["AO_Facility_ID"]]["0"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">25<51"]) && $row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["ao"][$row["AO_Facility_ID"]][">25<51"] += 1;
	} elseif($row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["ao"][$row["AO_Facility_ID"]][">25<51"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">50<101"]) && $row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["ao"][$row["AO_Facility_ID"]][">50<101"] += 1;
	} elseif($row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["ao"][$row["AO_Facility_ID"]][">50<101"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">100<201"]) && $row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["ao"][$row["AO_Facility_ID"]][">100<201"] += 1;
	} elseif($row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["ao"][$row["AO_Facility_ID"]][">100<201"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">200<501"]) && $row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["ao"][$row["AO_Facility_ID"]][">200<501"] += 1;
	} elseif($row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["ao"][$row["AO_Facility_ID"]][">200<501"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">500<1001"]) && $row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["ao"][$row["AO_Facility_ID"]][">500<1001"] += 1;
	} elseif($row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["ao"][$row["AO_Facility_ID"]][">500<1001"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">1000<2001"]) && $row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["ao"][$row["AO_Facility_ID"]][">1000<2001"] += 1;
	} elseif($row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["ao"][$row["AO_Facility_ID"]][">1000<2001"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">2000<5001"]) && $row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["ao"][$row["AO_Facility_ID"]][">2000<5001"] += 1;
	} elseif($row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["ao"][$row["AO_Facility_ID"]][">2000<5001"] = 1;
	}
	
	if(isset($counts["ao"][$row["AO_Facility_ID"]][">5000"]) && $row["Total_Acs"] > 5000) {
		$counts["ao"][$row["AO_Facility_ID"]][">5000"] += 1;
	} elseif($row["Total_Acs"] > 5000) {
		$counts["ao"][$row["AO_Facility_ID"]][">5000"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]]["total"])) {
		$counts["office"][$row["Facility_ID"]]["total"] += 1;
	} else {
		$counts["office"][$row["Facility_ID"]]["total"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">0<26"]) && $row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["office"][$row["Facility_ID"]][">0<26"] += 1;
	} elseif($row["Total_Acs"] <= 25 && $row["Total_Acs"] >= 1) {
		$counts["office"][$row["Facility_ID"]][">0<26"] = 1;
	}
	
		
	if(isset($counts["office"][$row["Facility_ID"]]["0"]) && $row["Total_Acs"] == 0) {
		$counts["office"][$row["Facility_ID"]]["0"] += 1;
	} elseif($row["Total_Acs"] == 0) {
		$counts["office"][$row["Facility_ID"]]["0"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">25<51"]) && $row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["office"][$row["Facility_ID"]][">25<51"] += 1;
	} elseif($row["Total_Acs"] > 25 && $row["Total_Acs"] < 51) {
		$counts["office"][$row["Facility_ID"]][">25<51"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">50<101"]) && $row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["office"][$row["Facility_ID"]][">50<101"] += 1;
	} elseif($row["Total_Acs"] > 50 && $row["Total_Acs"] < 101) {
		$counts["office"][$row["Facility_ID"]][">50<101"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">100<201"]) && $row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["office"][$row["Facility_ID"]][">100<201"] += 1;
	} elseif($row["Total_Acs"] > 100 && $row["Total_Acs"] < 201) {
		$counts["office"][$row["Facility_ID"]][">100<201"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">200<501"]) && $row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["office"][$row["Facility_ID"]][">200<501"] += 1;
	} elseif($row["Total_Acs"] > 200 && $row["Total_Acs"] < 501) {
		$counts["office"][$row["Facility_ID"]][">200<501"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">500<1001"]) && $row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["office"][$row["Facility_ID"]][">500<1001"] += 1;
	} elseif($row["Total_Acs"] > 500 && $row["Total_Acs"] < 1001) {
		$counts["office"][$row["Facility_ID"]][">500<1001"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">1000<2001"]) && $row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["office"][$row["Facility_ID"]][">1000<2001"] += 1;
	} elseif($row["Total_Acs"] > 1000 && $row["Total_Acs"] < 2001) {
		$counts["office"][$row["Facility_ID"]][">1000<2001"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">2000<5001"]) && $row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["office"][$row["Facility_ID"]][">2000<5001"] += 1;
	} elseif($row["Total_Acs"] > 2000 && $row["Total_Acs"] < 5001) {
		$counts["office"][$row["Facility_ID"]][">2000<5001"] = 1;
	}
	
	if(isset($counts["office"][$row["Facility_ID"]][">5000"]) && $row["Total_Acs"] > 5000) {
		$counts["office"][$row["Facility_ID"]][">5000"] += 1;
	} elseif($row["Total_Acs"] > 5000) {
		$counts["office"][$row["Facility_ID"]][">5000"] = 1;
	}
	
	$idNameMapping["region"][$row["Region_ID"]] = $row["Region"];
	$idNameMapping["division"][$row["Division_ID"]] = $row["Division"];
	$idNameMapping["subdivision"][$row["Sub_Division_ID"]] = $row["Sub_Division"];
	$idNameMapping["ao"][$row["AO_Facility_ID"]] = $row["AO_Name"];
	$idNameMapping["office"][$row["Facility_ID"]] = $row["Office_Name"];
	
	
	
	if(isset($data[$row["Region_ID"]])) {
		if(isset($data[$row["Region_ID"]][$row["Division_ID"]])) {
			if(isset($data[$row["Region_ID"]][$row["Division_ID"]][$row["Sub_Division_ID"]])) {
				if(isset($data[$row["Region_ID"]][$row["Division_ID"]][$row["Sub_Division_ID"]][$row["AO_Facility_ID"]])) {
					array_push($data[$row["Region_ID"]][$row["Division_ID"]][$row["Sub_Division_ID"]][$row["AO_Facility_ID"]], $row["Facility_ID"]);
				} else {
					$data[$row["Region_ID"]][$row["Division_ID"]][$row["Sub_Division_ID"]][$row["AO_Facility_ID"]] = [$row["Facility_ID"]];
				} 
			} else {
				$data[$row["Region_ID"]][$row["Division_ID"]][$row["Sub_Division_ID"]] = [
				$row["AO_Facility_ID"] => [$row["Facility_ID"]]];
			} 
		} else {
			$data[$row["Region_ID"]][$row["Division_ID"]] = [$row["Sub_Division_ID"] => [
			$row["AO_Facility_ID"] => [$row["Facility_ID"]]]];
		}
	} else {
		$data[$row["Region_ID"]] = [$row["Division_ID"] => [$row["Sub_Division_ID"] => [
			$row["AO_Facility_ID"] => [$row["Facility_ID"]]]
		]];
	}
}

echo json_encode(["idNameMapping" => $idNameMapping, "count" => $counts,"names" => $data]);

?>