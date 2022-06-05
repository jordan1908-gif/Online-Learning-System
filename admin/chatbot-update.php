<?php

require 'conn.php';
$errors = array();

if(isset($_POST['update-student']))
{
    $id     = $_POST['update_id'];
    $query  = $_POST['query'];
    $reply  = $_POST['reply'];

    $query = "UPDATE chatbot SET queries='$query', replies= '$reply' WHERE id='$id'";
    $execute = mysqli_query($conn, $query);
    if ($execute)
    {
        echo '<script> alert("Query has been updated successfully!"); 
        window.location="admin-chatbot.php";
        </script>';
    }
    else
    {
        echo '<script> alert("An error has occured!"); </script>';
    }
}


?>