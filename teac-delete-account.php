<?php
session_start();
include('config.php');

$log_userid = $_SESSION['teach_id'];

if(isset($_POST['delete-teac-acc'])){
	//Get the id of the student
	$sql = "SELECT * FROM teacher WHERE teac_id = '$log_userid'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$tid = $row['teac_id'];
	
	$sql = "DELETE FROM teacher WHERE teac_id = $tid";
	if(mysqli_query($conn, $sql)){
		echo '<script>alert("Account Has Been Deleted.")</script>';
		echo '<script>window.location.href="index.php"</script>';
	}
	else{
		echo '<script>alert("Failed to Delete Your Account")</script>';
	}
}
mysqli_close($conn);
?>