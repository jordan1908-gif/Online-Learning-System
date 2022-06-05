<?php
include "conn.php";

$sid = ($_GET['sid']);

$sql = "DELETE FROM student WHERE stud_id=$sid";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)<0)
{
    echo "<script>alert('Unable to delete student information!');";
    die ("window.location.href='admin-mgstudent.php';</script>");
}

    echo "<script>alert('Student information have been deleted!');</script>";
    echo "<script>window.location.href='admin-mgstudent.php';</script>";
?>