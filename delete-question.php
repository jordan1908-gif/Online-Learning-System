<?php 
include 'config.php';

extract($_GET);
$delete = $conn->query("DELETE FROM quiz_question where quques_id=".$id);

if($delete)
	echo true;
?>