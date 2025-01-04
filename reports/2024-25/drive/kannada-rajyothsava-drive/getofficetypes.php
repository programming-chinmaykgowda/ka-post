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


$sql = "SELECT DISTINCT Office_Type FROM rajyothsava_drive;
$result = $conn->query($sql);

$officeTypes = [];
while ($row = $result->fetch_assoc()) {
    $officeTypes[] = $row["Office_Type"];
}



$conn->close();

echo json_encode($officeTypes);
?>