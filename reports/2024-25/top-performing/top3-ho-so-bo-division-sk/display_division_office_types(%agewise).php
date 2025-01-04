<?php
include 'connection.php'; // Include the database connection file

// SQL query to retrieve the top three offices (H.O, S.O, B.O combined) in each division under SK Region
$sql = "SELECT Division, Office_Name, Sub_Division, Total_Acs, posb_Achievement, Office_Type
        FROM (
            SELECT Division, Office_Name, Sub_Division, Total_Acs, posb_Achievement, Office_Type,
                ROW_NUMBER() OVER(PARTITION BY Division, Office_Type ORDER BY posb_Achievement DESC) AS row_num
            FROM posb_karnataka1_24_25
            WHERE Office_Type IN ('Gazetted', 'HSG-I', 'HSG-II','LSG','A-Class','B-Class','C-Class', 'B.O')
            AND Region = 'SK Region'  -- Filter by SK Region
        ) AS ranked
        WHERE row_num <= 3
        ORDER BY Division, FIELD(Office_Type, 'Gazetted', 'HSG-I', 'HSG-II','LSG','A-Class','B-Class','C-Class', 'B.O'), row_num";

$result = $conn->query($sql);

// Initialize variables to keep track of the current division and office type
$currentDivision = "";
$currentOfficeType = "";
$serialNumber = 1; // Initialize the serial number



echo "<h2 style='text-align:center;'>Top 3 Head Offices, Sub Offices & Branch Offices in Each Division under SK Region(Percentage of posb_Achievement wise)</h2>";

echo "<table>";



while ($row = $result->fetch_assoc()) {
    $division = $row['Division'];
    $officeType = $row['Office_Type'];
    $officeName = $row['Office_Name'];
    $subDivision = $row['Sub_Division'];
    $totalAccounts = $row['Total_Acs'];
    $posb_Achievement = $row['posb_Achievement'];

    // Check if a new division or office type is encountered
    if ($currentDivision != $division || $currentOfficeType != $officeType) {
        if ($currentDivision != "") {
            // Close the previous table before starting a new division or office type
            echo "</table>";
        }

        echo "<h3 style='text-align:center; font-size: 24px;'><u> $division Division: TOP- $officeType s</u></h3>";
        echo "<table>";
        echo "<tr>
            <th>Office Name</th>
            <th>Sub Division</th>
            <th class='small-column'>Total A/Cs</th>
            <th class='small-column'>%age</th>
            <th class='small-column'>Position</th>
        </tr>";
        $currentDivision = $division;
        $currentOfficeType = $officeType;
        $serialNumber = 1; // Reset the serial number for each division and office type
    }

    // Display office data
    echo "<tr>
        <td>$officeName</td>
        <td>$subDivision</td>
        <td class='small-column'>$totalAccounts</td>
        <td class='small-column'>$posb_Achievement</td>
        <td class='small-column'>$serialNumber</td>
    </tr>";
    $serialNumber++; // Increment the serial number
}

// Close the final table
echo "</table>";

$conn->close(); // Close the database connection
?>
