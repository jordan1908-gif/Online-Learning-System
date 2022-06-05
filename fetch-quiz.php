<?php
include 'config.php';
	
	$qry = $conn->query("SELECT * from quiz where id='".$_GET['id']."' ");
	if($qry){
		echo json_encode($qry->fetch_array());
	}
?>