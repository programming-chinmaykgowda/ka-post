<?php 

$connection = @mysqli_connect("localhost","root","","u562946175_kapost");

$production = false;

if(!$connection){
    echo json_encode(array('error' => "Internal Server Error! Please contact the administrator"));
    die();
}

?>