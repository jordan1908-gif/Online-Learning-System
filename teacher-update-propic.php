<?php
include("teacher-session.php");
include('config.php');

$log_userid = $_SESSION['teach_id'];
$retrievesql = "SELECT * FROM teacher WHERE teac_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];

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
            $sql = "UPDATE teacher SET teac_profile_picture = '$new_propic' WHERE teac_id = '$tid'";
            if(mysqli_query($conn, $sql)){
                echo '<script>alert("Profile picture has been change successfully")</script>';
                echo '<script>window.location.href = "teacher-profile.php"</script>';
            } else {
                echo '<script>alert("Failed to update.")</script>';
                echo '<script>window.location.href = "teacher-profile.php"</script>';
            }
        } else {
            echo '<script>alert("Failed to update.")</script>';
        }
    } else{
    };
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "teacher-profile.php"</script>';
}
mysqli_close($conn);

?>