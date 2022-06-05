<?php 
include 'config.php';
extract($_GET);
$get = $conn->query("SELECT * FROM quiz_question where quiz_id= ".$id)->fetch_array();
$delete = $conn->query("DELETE FROM quiz where quiz_id= ".$id);
$delete1 = $conn->query("DELETE FROM quiz_question where quiz_id= ".$id);
if($delete)
{
    echo true;
}
else
{
    echo '<script> alert("An error has occured!"); </script>';
}
?>