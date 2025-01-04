<?php
$region = $_GET["region"];

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

$sql = "SELECT DISTINCT Division, Division_ID FROM rajyothsava_drive WHERE Region_ID = '$region'";
$result = $conn->query($sql);

$divisions = [];
while ($row = $result->fetch_assoc()) {
    $divisions[] = ["id" => $row["Division_ID"], "name" => $row["Division"]];
}

$conn->close();

echo json_encode($divisions);
?>
