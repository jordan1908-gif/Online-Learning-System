<?php
session_start();

if (!isset($_SESSION['adm_id']))
{
		echo "<script>alert('Please login!'); window.location.href='admin-login-page.php';</script>";
}
else{
	$aid = $_SESSION["adm_id"];
}	
?>