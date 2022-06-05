<?php

require 'conn.php';
$errors = array();

if(isset($_POST['update-student']))
{
    $id         = $_POST['update_id'];
    $username   = $_POST['stud_username'];
    $fname      = $_POST['stud_first_name'];
    $lname      = $_POST['stud_last_name'];
    $email      = $_POST['stud_email'];
    $verified   = $_POST['verified'];


        $query = "UPDATE student SET stud_first_name='$fname', stud_last_name= '$lname', stud_username='$username', stud_email = '$email', verified = '$verified'  WHERE stud_id='$id'";
        $execute = mysqli_query($conn, $query);
        if ($execute)
        {
            echo '<script> alert("Student details updated successfully!"); 
            window.location="admin-mgstudent.php";
            </script>';
        }
        else
        {
            echo '<script> alert("An error has occured!"); </script>';
        }
    }


?>