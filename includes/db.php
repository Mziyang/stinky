<?php

$con = mysqli_connect("localhost","root", "","stinky");

if (
    mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
}
//Multilingual supports
mysqli_query($con,"SET NAMES 'UTF8'");
?>

