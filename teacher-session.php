<?php
session_start();

if (!isset($_SESSION['teach_id']))
{
		echo "<script>alert('Please login!'); window.location.href='index.php';</script>";
}
else{
	$id = $_SESSION['teach_id'];
}	
?>