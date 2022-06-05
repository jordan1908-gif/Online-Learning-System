<?php

require 'conn.php';

if(isset($_POST['update-quiz']))
{
    $id     = $_POST['update_id'];
    $title  = $_POST['quiz_title'];
    $category     = $_POST['quiz_category'];
    $timer  = $_POST['quiz_timer'];
    $point  = $_POST['quiz_point'];
    $description  = $_POST['quiz_description'];

    $query = "UPDATE quiz SET quiz_title='$title', quiz_category='$category', quiz_timer='$timer', quiz_point= '$point', quiz_description = '$description'  WHERE quiz_id='$id'";
    $execute = mysqli_query($conn, $query);

    if ($execute)
    {
		echo '<script> alert("Quiz updated successfully!"); 
		window.location="admin-quiz.php";
		</script>';
	}
	else
	{
		echo '<script> alert("An error has occured!"); </script>';
	}
}
?>