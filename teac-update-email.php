<?php
session_start();
include('config.php');

$log_userid = $_SESSION['teach_id'];
$new_email = $_POST['new-email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM teacher WHERE teac_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if (password_verify($pass, $row['teac_password'])) {
    $sqlcheckemail =  "SELECT * FROM teacher WHERE teac_email LIKE '$new_email'";
    $emailexists = mysqli_query($conn, $sqlcheckemail);
    if(mysqli_num_rows($emailexists) > 0) {
        echo '<script>alert("Email already exists, please try a different email!")</script>';
        echo '<script>window.location.href = "teacher-accsetting.php"</script>';
    } else {
        $sql = "UPDATE teacher SET teac_email = '$new_email' WHERE teac_id= '$log_userid'";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Email has been change successfully")</script>';
            echo '<script>window.location.href = "teacher-accsetting.php"</script>';
        } else {
            echo '<script>alert("Unable to change your email")</script>';
            echo '<script>window.location.href = "teacher-accsetting.php"</script>';
        }
    }
} else {
echo '<script>alert("Please enter the correct password.")</script>';
echo '<script>window.location.href = "teacher-accsetting.php"</script>';
}
mysqli_close($conn);

?>