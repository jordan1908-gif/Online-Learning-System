<?php 

require 'config.php';

if(isset($_POST['insert-quiz']))
{
	$title  		= $_POST['quiz_title'];
	$category  		= $_POST['quiz_category'];
	$timer  		= $_POST['quiz_timer'];
	$points 		= $_POST['quiz_point'];
	$description 	= $_POST['quiz_description'];
	$date			= $_POST['quiz_create_date'];
	$tid			= $_POST['tid'];

	if (isset($_FILES['image'])) {
        $target_dir = "Images/";
        $target_file = $target_dir.basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $image = $_FILES['image']['name'];
    }

	$query = "INSERT INTO quiz (`quiz_title`, `quiz_category`, `quiz_cover`, `quiz_timer`, `quiz_point`, `quiz_description`, `quiz_create_date`, `teac_id`) VALUES ('$title', '$category', '$image', '$timer', '$points', '$description', '$date', '$tid')";
	$execute = mysqli_query($conn, $query);

	if($execute) 
	{
		echo '<script> alert("Quiz added successfully!"); 
		window.location="teacher-quiz.php";
		</script>';
	}
	else
	{
		echo '<script> alert("An error has occured!"); </script>';
	}
}

?>