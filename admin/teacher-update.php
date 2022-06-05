<?php

require 'conn.php';
$errors = array();

if(isset($_POST['update-teacher']))
{
    $id         = $_POST['update_id'];
    $username   = $_POST['teac_username'];
    $fname      = $_POST['teac_first_name'];
    $lname      = $_POST['teac_last_name'];
    $email      = $_POST['teac_email'];
    $verified   = $_POST['verified'];

    $query = "UPDATE teacher SET teac_username='$username', teac_email = '$email', teac_first_name='$fname', teac_last_name= '$lname', teac_status = '$verified'  WHERE teac_id='$id'";
    $execute = mysqli_query($conn, $query);
    if ($execute)
    {
        echo '<script> alert("Teacher details updated successfully!"); 
        window.location="admin-mgteacher.php";
        </script>';
    }
    else
    {
        echo '<script> alert("An error has occured!"); </script>';
    }
}

?>