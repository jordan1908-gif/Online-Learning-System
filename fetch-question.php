<?php
include 'config.php';
	
	$qry = $conn->query("SELECT * from quiz_question where quques_id='".$_GET['id']."'");
	if($qry){
		echo json_encode($qry->fetch_array());
	}
?>