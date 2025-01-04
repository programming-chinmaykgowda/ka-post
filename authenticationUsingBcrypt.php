<?php

include "config.php";

$query = "SELECT * FROM `loginhsnmainpage` WHERE `username` = ?";

$stmt = mysqli_stmt_init($connection);

if(!mysqli_stmt_prepare($stmt, $query)){
    if(!$production){
        echo "<div class='alert alertRed h3'>".mysqli_stmt_error($stmt)."</div><br/><br/>";
    } else {
        echo "<div class='alert alertRed h3'>Internal Server Error! Please Contact the administrator.</div><br/><br/>";
    }
} else {
    $username = mysqli_real_escape_string($connection, $_POST['user']);

    mysqli_stmt_bind_param($stmt, "i", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if(password_verify($_POST['pass'], $row['password'])){
            session_start();
            $_SESSION['usertoken'] = $username;
            header("location: index.php");
        } else {
            echo "<div class='alert alertRed h3'>Incorrect Password.</div><br/><br/>";
        }
    }

    if(mysqli_num_rows($result)){
        
    } else {
        echo "<div class='alert alertRed h3'>Sorry the username you have entered is incorrect.</div><br/><br/>";
    }
}
?>