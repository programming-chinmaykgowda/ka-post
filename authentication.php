<?php

include "config.php";

$query = "SELECT * FROM `loginhsnmainpage` WHERE `username` = ? && `password` = ?";

$stmt = mysqli_stmt_init($connection);

if(!mysqli_stmt_prepare($stmt, $query)){
    if(!$production){
        echo "<div class='alert alertRed h3'>".mysqli_stmt_error($stmt)."</div><br/><br/>";
    } else {
        echo "<div class='alert alertRed h3'>Internal Server Error! Please Contact the administrator.</div><br/><br/>";
    }
} else {
    $username = mysqli_real_escape_string($connection, $_POST['user']);
    $password = mysqli_real_escape_string($connection, $_POST['pass']);

    mysqli_stmt_bind_param($stmt, "is", $username, $password);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result)){
        session_start();
        $_SESSION['usertoken'] = $username;
        header("location: index.php");
    } else {
        echo "<div class='alert alertRed h3'>Invalid Username or password.</div><br/><br/>";
    }
}
?>