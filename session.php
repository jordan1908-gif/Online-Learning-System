<?php
session_start();

if (!isset($_SESSION['id']))
{
		echo "<script>alert('Please login!'); window.location.href='index.php';</script>";
}
else{
	$id = $_SESSION["id"];
}	
?>