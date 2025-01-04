<?php
include 'connection.php'; // Include the database connection file

// SQL query to retrieve the top three offices (H.O, S.O, B.O combined) in each division under SK Region
$sql = "SELECT Division, Office_Name, Sub_Division, Total_Acs, Office_Type
        FROM (
            SELECT Division, Office_Name, Sub_Division, Total_Acs, Office_Type,
                ROW_NUMBER() OVER(PARTITION BY Division, Office_Type ORDER BY Total_Acs DESC) AS row_num
            FROM posb_karnataka1_24_25
            WHERE Office_Type IN ('H.O', 'S.O', 'B.O')
            AND Region = 'SK Region'  -- Filter by SK Region
        ) AS ranked
        WHERE row_num <= 3
        ORDER BY Division, FIELD(Office_Type, 'H.O', 'S.O', 'B.O'), row_num";

$result = $conn->query($sql);

// Initialize variables to keep track of the current division and office type
$currentDivision = "";
$currentOfficeType = "";
$serialNumber = 1; // Initialize the serial number

echo "<h2 style='text-align:center;'>Top 3 Head Offices, Sub Offices & Branch Offices in Each Division under SK Region (2023-24)</h2>";

while ($row = $result->fetch_assoc()) {
    $division = $row['Division'];
    $officeType = $row['Office_Type'];
    $officeName = $row['Office_Name'];
    $subDivision = $row['Sub_Division'];
    $totalAccounts = $row['Total_Acs'];

    // Check if a new division or office type is encountered
    if ($currentDivision != $division || $currentOfficeType != $officeType) {
        if ($currentDivision != "") {
            // Close the previous table before starting a new division or office type
            echo "</table>";
        }

        echo "<h3 style='text-align:center; font-size: 24px;'><u> $division Division: Top- $officeType s</u></h3>";
        echo "<table>";
        echo "<tr><th>Office Name</th><th>Sub Division</th><th>Total Accounts</th><th>Position</th></tr>";
        $currentDivision = $division;
        $currentOfficeType = $officeType;
        $serialNumber = 1; // Reset the serial number for each division and office type
    }

    // Display office data
    echo "<tr><td>$officeName</td><td>$subDivision</td><td style='text-align:center;'>$totalAccounts</td><td style='text-align:center;'>$serialNumber</td></tr>";
    $serialNumber++; // Increment the serial number
}

// Close the final table
echo "</table>";

$conn->close(); // Close the database connection
?>