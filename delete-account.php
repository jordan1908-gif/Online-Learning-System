<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];

if(isset($_POST['delete-stud-acc'])){
	//Get the id of the student
	$sql = "SELECT * FROM student WHERE stud_id = '$log_userid'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sid = $row['stud_id'];
	
	$sql = "DELETE FROM student WHERE stud_id = $sid";
	if(mysqli_query($conn, $sql)){
		$sql = "DELETE FROM answer WHERE stud_id = $sid";
		if(mysqli_query($conn, $sql)){
			$sql = "DELETE FROM history WHERE stud_id = $sid";
			if(mysqli_query($conn, $sql)){ 
				$sql = "DELETE FROM question WHERE stud_id = $sid";
				if(mysqli_query($conn, $sql)){ 
					$sql = "DELETE FROM result WHERE stud_id = $sid";
					if(mysqli_query($conn, $sql)){ 
					}
				}
			}
		}
		echo '<script>alert("Account Has Been Deleted.")</script>';
		echo '<script>window.location.href="index.php"</script>';
	}
	else{
		echo '<script>alert("Failed to Delete Your Account")</script>';
	}
}
mysqli_close($conn);
?>