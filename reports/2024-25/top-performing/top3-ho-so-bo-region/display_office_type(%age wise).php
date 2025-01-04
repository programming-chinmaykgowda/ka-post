<?php
include 'connection.php'; // Include the database connection file

// Define the office types
$officeTypes = ['Gazetted', 'HSG-I', 'HSG-II', 'LSG', 'A-Class', 'B-Class', 'C-Class', 'B.O'];

// Initialize variables to keep track of the current region for each office type
$currentRegions = array_fill_keys($officeTypes, "");
$serialNumbers = array_fill_keys($officeTypes, 1);

echo "<h2 style='text-align:center;'>Top 3 Departmental Offices & Branch Offices under SK Region (2024-25)</h2>";

foreach ($officeTypes as $officeType) {
    // Prepare and execute SQL query to retrieve the top three offices of the specified type in each region
    $sql = "SELECT Region, Office_Name, Division, Total_Acs, posb_Achievement
            FROM (
                SELECT Region, Office_Name, Division, Total_Acs, posb_Achievement,
                    ROW_NUMBER() OVER(PARTITION BY Region ORDER BY posb_Achievement DESC) AS row_num
                FROM posb_karnataka1_24_25
                WHERE Office_Type = ?
            ) AS ranked
            WHERE row_num <= 3
            ORDER BY Region, posb_Achievement DESC";

    // Use prepared statements to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $officeType);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the results for the specified office type
        echo "<h3 style='text-align:center; font-size: 24px;'><u>Top 3 $officeType :</u></h3>";
        echo "<table border='1' style='width:100%; border-collapse:collapse;'>";
        echo "<tr><th>Office Name</th><th>Division</th><th>Total Accounts</th><th>posb_Achievement</th><th>Position</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $region = $row['Region'];
            $officeName = $row['Office_Name'];
            $division = $row['Division'];
            $totalAccounts = $row['Total_Acs'];
            $posb_Achievement = $row['posb_Achievement'];

            // Check if a new region is encountered for the current office type
            if ($currentRegions[$officeType] != $region) {
                // Optionally display region as a header row
                // echo "<tr><td colspan='5' style='text-align:center;'><strong>$region</strong></td></tr>";
                $currentRegions[$officeType] = $region;
                $serialNumbers[$officeType] = 1; // Reset the serial number for each region
            }

            // Display office data
            echo "<tr><td>$officeName</td><td>$division</td><td style='text-align:center;'>$totalAccounts</td><td>$posb_Achievement</td><td style='text-align:center;'>{$serialNumbers[$officeType]}</td></tr>";
            $serialNumbers[$officeType]++; // Increment the serial number
        }

        echo "</table>";

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close(); // Close the database connection
?>
