<?php
session_start();
$con = mysqli_connect('localhost','hasan','12345','phpexercise');
mysqli_set_charset($con, "utf8mb4");
$tarix = date('Y-m-d H:i:s');
?>
