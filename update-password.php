<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];
$current_pass = $_POST['cur-pass'];
$new_pass = $_POST['new-pass'];
$conf_pass = $_POST['conf-pass'];

$sql = "SELECT * FROM student WHERE stud_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($new_pass != $conf_pass) {
    echo '<script>alert("The password do not match. Please re-enter your password.")</script>';
    echo '<script>window.location.href="student-accsetting.php"</script>';
} elseif (password_verify($current_pass, $row['hashed_password'])) {
    $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
    $sql = "UPDATE student SET hashed_password = '$new_pass' WHERE stud_id= '$log_userid'";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Password has been change successfully.")</script>';
        echo '<script>window.location.href="student-accsetting.php";</script>';
    } else {
        echo '<script>alert("Unable to change your password")</script>';
        echo '<script>window.location.href="student-accsetting.php";</script>';
    } 
} else {
    echo '<script>alert("Current password does not matched. Pleasr try again")</script>';
    echo '<script>window.location.href = "student-accsetting.php"</script>';
}
mysqli_close($conn);
?>