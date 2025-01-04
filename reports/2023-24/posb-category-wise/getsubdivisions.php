<?php
$region = $_GET["region"];
$division = $_GET["division"];


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

$sql = "SELECT DISTINCT Sub_Division,Sub_Division_ID FROM posb_karnataka_2023_24 WHERE Region_ID = '$region' AND Division_ID = '$division'";
$result = $conn->query($sql);

$subdivisions = [];
while ($row = $result->fetch_assoc()) {
    $subdivisions[] = ["id" => $row["Sub_Division_ID"], "name" => $row["Sub_Division"]];
}

$conn->close();

echo json_encode($subdivisions);
?>