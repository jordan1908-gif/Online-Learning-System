<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "skillsoft";

$conn = mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "<script type='text/javascript'>alert('Failed to connect to MySQL.');</script>";
    exit();
}else{
    #echo "<script type='text/javascript'>alert('Connection established.');</script>";
}
?>