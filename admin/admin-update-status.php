<?php
include("conn.php");
$teac_id = $_GET['teac_id'];

$sql = "UPDATE teacher SET teac_status='Verified' where teac_id = '$teac_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)<0)
{
    echo "<script>alert('Unable to update teacher status');";
    die ("window.location.href='admin-mgteacher.php';</script>");
}

    echo "<script>alert('Teacher have been successfully approved!!');</script>";
    echo "<script>window.location.href='admin-mgteacher.php';</script>";
?>


