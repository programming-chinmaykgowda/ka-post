<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hassan Division Portal</title>
    <link rel="stylesheet" href="GenricLibrary.css">
    <link rel="stylesheet" href="RainbowForm.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

        <div class="rainbowFormContainer">
            
        <?php
            if(@isset($_POST['user'])){
                include "authenticationUsingBcrypt.php";
            }
        ?>
                <form method="post" class="rainbowForm">

                <h1 class="h1">Enter Password</h1>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="user" class="form-control" required="" autocomplete="off" value="<?php if(isset($_POST['user'])){
                        echo $_POST['user'];
                        }; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="pass" class="form-control" required="" autocomplete="off" value="<?php if(isset($_POST['pass'])){
                        echo $_POST['pass'];
                        }; ?>" >
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="showPassword" onchange="toogleShowPassword()" value="YES" />
                    <label for="showPassword">Show Password</label>
                </div>
                <input type="Submit" name="login" value="Login" class="btn btnGreen" />
            </form>
        </div>
        <script type="text/javascript">
            function toogleShowPassword(){
            console.log(document.querySelector("#password").type);
                if(document.querySelector("#password").type == 'password'){
                    document.querySelector("#password").type = 'text';
                } else {
                    document.querySelector("#password").type = 'password';
                }
            }
        </script>
</body>
</html>