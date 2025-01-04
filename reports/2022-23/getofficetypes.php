<?php
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


$sql = "SELECT DISTINCT Office_Type FROM posb_karnataka_2022_23";
$result = $conn->query($sql);

$officeTypes = [];
while ($row = $result->fetch_assoc()) {
    $officeTypes[] = $row["Office_Type"];
}



$conn->close();

echo json_encode($officeTypes);
?>