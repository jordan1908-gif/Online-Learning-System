<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];
$retrievesql = "SELECT * FROM student WHERE stud_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];

if(isset($_POST['update-profile'])) {

    //Name of the uploaded profile picture
    $new_propic = $_FILES['new_propic']['name'];
    //Destination
    $destination = 'Images/' . $new_propic;

    //Get the file extension
    $extension = pathinfo($new_propic, PATHINFO_EXTENSION);

    $file = $_FILES['new_propic']['tmp_name'];

    if(!empty($new_propic)){
        if(move_uploaded_file($file, $destination)) {
            $sql = "UPDATE student SET stud_profile_picture = '$new_propic' WHERE stud_id = '$sid'";
            if(mysqli_query($conn, $sql)){
                echo '<script>alert("Profile picture has been change successfully")</script>';
                echo '<script>window.location.href = "student-prosetting.php"</script>';
            } else {
                echo '<script>alert("Failed to update.")</script>';
                echo '<script>window.location.href = "student-prosetting.php"</script>';
            }
        } else {
            echo '<script>alert("Failed to update.")</script>';
        }
    } else{
    };
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "student-prosetting.php"</script>';
}
mysqli_close($conn);

?>