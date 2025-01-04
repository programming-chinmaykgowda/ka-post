<?php
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

$sql = "SELECT DISTINCT Region,Region_ID FROM rajyothsava_drive";
$result = $conn->query($sql);

$regions = [];
while ($row = $result->fetch_assoc()) {
    $regions[] = ["id" => $row["Region_ID"], "name" => $row["Region"]];
}

$conn->close();

echo json_encode($regions);
?>