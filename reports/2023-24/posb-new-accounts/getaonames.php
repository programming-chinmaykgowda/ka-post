<?php
$region = $_GET["region"];
$division = $_GET["division"];
$subdivision = $_GET["subdivision"];

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
$sql = "SELECT DISTINCT AO_Name,AO_Facility_ID FROM posb_karnataka1_23_24 WHERE Region_ID = '$region' AND Division_ID = '$division' AND Sub_Division_ID = '$subdivision'";
$result = $conn->query($sql);

$aonames = [];
while ($row = $result->fetch_assoc()) {
    $aonames[] = ["id" => $row["AO_Facility_ID"], "name" => $row["AO_Name"]];
}

$conn->close();

echo json_encode($aonames);
?>