<?php
include "conn.php";

$adm_id = ($_GET['adm_id']);

$sql = "DELETE FROM admin WHERE adm_id=$adm_id";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)<0)
{
    echo "<script>alert('Unable to delete admin information!');";
    die ("window.location.href='admin-mgadmin.php';</script>");
}

    echo "<script>alert('Admin information have deleted!');</script>";
    echo "<script>window.location.href='admin-mgadmin.php';</script>";
?>