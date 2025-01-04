<?php
include 'connection.php'; // Include the database connection file

// Define the office types (H.O, S.O, and B.O)
$officeTypes = ['H.O', 'S.O', 'B.O'];

// Initialize variables to keep track of the current region for each office type
$currentRegions = array_fill_keys($officeTypes, "");
$serialNumbers = array_fill_keys($officeTypes, 1);

echo "<h2 style='text-align:center;'>Top 3 Head Offices, Sub Offices & Branch Offices under SK Region</h2>";

foreach ($officeTypes as $officeType) {
    // SQL query to retrieve the top three offices of the specified type in each region
 $sql = "SELECT Region, Office_Name, Division, Total_Acs, Achievement
            FROM (
                SELECT Region, Office_Name, Division, Total_Acs, Achievement,
                    ROW_NUMBER() OVER(PARTITION BY Region ORDER BY  Achievement DESC) AS row_num
                FROM posb_karnataka1_23_24
                WHERE Office_Type = '$officeType'
            ) AS ranked
            WHERE row_num <= 3
            ORDER BY Region, Achievement DESC";










    $result = $conn->query($sql);

    // Display the results for the specified office type
    echo "<h3 style='text-align:center; font-size: 24px;'><u>Top 3 $officeType s:</u></h3>";
    echo "<table>";
    echo "<tr><th>Office Name</th><th>Division</th><th>Total Accounts</th><th>Achievement</th><th>Position</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $region = $row['Region'];
        $officeName = $row['Office_Name'];
        $division = $row['Division'];
        $totalAccounts = $row['Total_Acs'];
        $achievement = $row['Achievement'];

        // Check if a new region is encountered for the current office type
        if ($currentRegions[$officeType] != $region) {
            // Display region as a header row
            // echo "<tr><td colspan='5' style='text-align:center;'><strong>$region</strong></td></tr>";
            $currentRegions[$officeType] = $region;
            $serialNumbers[$officeType] = 1; // Reset the serial number for each region
        }

        // Display office data
        echo "<tr><td>$officeName</td><td>$division</td><td style='text-align:center;'>$totalAccounts</td><td style='text-align:center;'>$achievement</td><td style='text-align:center;'>{$serialNumbers[$officeType]}</td></tr>";
        $serialNumbers[$officeType]++; // Increment the serial number
    }

    echo "</table>";
}

$conn->close(); // Close the database connection
?>
