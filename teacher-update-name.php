<?php
include("teacher-session.php");
include('config.php');

$log_userid = $_SESSION['teach_id'];
$retrievesql = "SELECT * FROM teacher WHERE teac_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];

if(isset($_POST['update-name'])) {
    //first name
    $new_fname = $_POST['new_fname'];
    $new_lname = $_POST['new_lname'];

    if(!empty($new_fname)){
        $sql = "UPDATE teacher SET teac_first_name = '$new_fname' WHERE teac_id = '$tid'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Unable to change your firstname")</script>';
        echo '<script>window.location.href = "teacher-profile.php"</script>';
    }

    if(!empty($new_lname)){
        $sql = "UPDATE teacher SET teac_last_name = '$new_lname' WHERE teac_id = '$tid'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Unable to change your lastname")</script>';
        echo '<script>window.location.href = "teacher-profile.php"</script>';
    }
    echo '<script>alert("First and last name has been change successfully")</script>';
    echo '<script>window.location.href = "teacher-profile.php"</script>';
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "teacher-profile.php"</script>';
}
mysqli_close($conn);

?>