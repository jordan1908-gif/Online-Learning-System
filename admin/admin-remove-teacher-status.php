<?php
include("conn.php");
$teac_id = $_GET['tid'];

$sql = "UPDATE teacher SET teac_status='Not Verified' where teac_id = '$teac_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)<0)
{
    echo "<script>alert('Unable to update teacher status');";
    die ("window.location.href='admin-mgteacher.php';</script>");
}

    echo "<script>alert('Status have been changed from the teacher account!');</script>";
    echo "<script>window.location.href='admin-mgteacher.php';</script>";
?>