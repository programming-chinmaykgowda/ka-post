<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSB Report</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #faebd7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 500px;
            background: #f0ffff ;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .container h1 {
            font-size: 24px;
            color: #FF0000;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        .container label {
            display: block;
            font-size: 14px;
            color: #0000cd;
            text-align: left;
            margin-bottom: 8px;
        }

        .container input[type="file"],
        .container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #dddddd;
            font-size: 14px;
        }

        .container button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            width: 100px;
            margin: 0 auto;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #0056b3;
        }

        .loading {
            display: none;
            margin-top: 10px;
            color: #007bff;
            font-size: 14px;
        }

        .logout-button {
            position: absolute;
            top: 60px;
            right: 15px;
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .logout-button:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .success-message {
            color: green;
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>POSB Report data Uploading Tool</h1>
        <a href="logout.php" class="logout-button">Logout</a>
        <form id="uploadForm">
            <label for="csvFile">Upload CSV File:</label>
            <input type="file" name="csvFile" id="csvFile" accept=".csv" required>
            <button type="submit" id="uploadBtn">Upload</button>
            <div class="loading" id="loadingIndicator">Uploading... Please wait</div>
        </form>
        <div class="output" id="output"></div>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);
    const output = document.getElementById('output');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const uploadBtn = document.getElementById('uploadBtn');
    const form = this; // Reference to the form

    // Show loading indicator
    loadingIndicator.style.display = 'block';
    uploadBtn.disabled = true;

    // Use Fetch API for AJAX file upload
    fetch('upload_process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        loadingIndicator.style.display = 'none';
        uploadBtn.disabled = false;
        output.innerHTML = result;

        // Reset the form to clear the file input
        form.reset();
    })
    .catch(error => {
        loadingIndicator.style.display = 'none';
        uploadBtn.disabled = false;
        output.innerHTML = `<p class="error-message">An error occurred: ${error.message}</p>`;
    });
});

        
        
    </script>
</body>
</html>
