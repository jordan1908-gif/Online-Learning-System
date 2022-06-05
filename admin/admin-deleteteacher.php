<?php
include "conn.php";

$tid = ($_GET['tid']);

$sql = "DELETE FROM teacher WHERE teac_id=$tid";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)<0)
{
    echo "<script>alert('Unable to delete teacher information!');";
    die ("window.location.href='admin-mgteacher.php';</script>");
}

    echo "<script>alert('Teacher information have been deleted successfully!');</script>";
    echo "<script>window.location.href='admin-mgteacher.php';</script>";
?>