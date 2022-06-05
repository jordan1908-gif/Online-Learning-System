<?php 
include 'conn.php';
extract($_GET);

$delete = $conn->query("DELETE FROM teacher where teac_id= ".$id);

if($delete)
{
    echo true;
}
else
{
    echo '<script> alert("An error has occured!"); </script>';
}
?>