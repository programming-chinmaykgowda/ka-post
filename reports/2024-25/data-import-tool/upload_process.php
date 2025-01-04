<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
            $servername = 'localhost';
            $username = 'u562946175_kapost';
            $password = 'Kanthu@1982';
            $dbname = 'u562946175_kapost';


    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("<p>Connection failed: " . $conn->connect_error . "</p>");
    }

    $fileTmpPath = $_FILES['csvFile']['tmp_name'];

    if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
        $header = fgetcsv($handle);
        $data = [];
        while (($row = fgetcsv($handle)) !== FALSE) {
            if (count($row) == count($header)) {
                $data[] = array_combine($header, $row);
            } else {
                die("<p>CSV format error: Header and row column counts do not match.</p>");
            }
        }
        fclose($handle);

        if (empty($data)) {
            die("<p>No data found in the uploaded CSV file.</p>");
        }

        $conn->begin_transaction();
        try {
            $sqlDelete = "DELETE FROM posb_karnataka1_24_25";
            if (!$conn->query($sqlDelete)) {
                throw new Exception("Error deleting old data: " . $conn->error);
            }

            foreach ($data as $row) {
                $columns = implode(",", array_map(fn($col) => "`" . $conn->real_escape_string($col) . "`", array_keys($row)));
                $values = implode(",", array_map(fn($val) => "'" . $conn->real_escape_string($val) . "'", array_values($row)));

                $sqlInsert = "INSERT INTO posb_karnataka1_24_25 ($columns) VALUES ($values)";
                if (!$conn->query($sqlInsert)) {
                    throw new Exception("Error inserting data: " . $conn->error);
                }
            }

            $conn->commit();
            echo '<p class="success-message">Old data deleted and new data imported successfully.</p>';
        } catch (Exception $e) {
            $conn->rollback();
            die("<p>Transaction failed: " . $e->getMessage() . "</p>");
        }
    } else {
        die("<p>Error reading the uploaded file.</p>");
    }

    $conn->close();
} else {
    echo "<p>No file uploaded.</p>";
}
?>
