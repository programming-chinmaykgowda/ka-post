<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $defaultCode = "Skro@123"; // Replace with your default 6-10 digit alphanumeric code
    $inputCode = trim($_POST['code']); // Sanitize input

    if ($inputCode === $defaultCode) {
        session_regenerate_id(true); // Prevent session fixation attacks
        $_SESSION['loggedin'] = true;
        header("Location: upload.php"); // Redirect to the upload page
        exit();
    } else {
        $error = "Invalid code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rajyothsava Drive</title>
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

        .login-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Adjusted width for better design */
            padding: 20px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 24px;
            color: #ff0000;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        
        .login-container h2 {
            font-size: 24px;
            color: #ff0000;
            margin-bottom: 20px;
            margin-top:5px;
            text-decoration: underline;
        }

        .login-container label {
            display: block;
            font-size: 14px;
            color: #00008b;
            text-align: left;
            margin-bottom: 8px;
        }

        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #dddddd;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        .login-container input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .login-container button {
            width: 50%; /* Adjusted width for a smaller button */
            margin: 0 auto; /* Centers the button */
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Rajyothsava Drive</h1>
           <h2>Login</h2></br>
           
        <form action="" method="post">
            <!--<label for="code">Enter password:</label>-->
            <input type="password" placeholder="Enter Password" name="code" id="code" maxlength="10" minlength="6" required>
            <button type="submit">Login</button>
            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
