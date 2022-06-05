<?php
session_start();
include('config.php');

$log_userid = $_SESSION['teach_id'];
$current_pass = $_POST['cur-pass'];
$new_pass = $_POST['new-pass'];
$conf_pass = $_POST['conf-pass'];

$sql = "SELECT * FROM teacher WHERE teac_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($new_pass != $conf_pass) {
    echo '<script>alert("The two password does not match. Please re-enter your password.")</script>';
    echo '<script>window.location.href="teacher-accsetting.php"</script>';
} elseif (password_verify($current_pass, $row['teac_password'])) {
    $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
    $sql = "UPDATE teacher SET teac_password = '$new_pass' WHERE teac_id= '$log_userid'";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Password has been change successfully.")</script>';
        echo '<script>window.location.href="teacher-accsetting.php";</script>';
    } else {
        echo '<script>alert("Unable to change your password")</script>';
        echo '<script>window.location.href="teacher-accsetting.php";</script>';
    } 
} else {
    echo '<script>alert("Current password does not matched. Pleasr try again")</script>';
    echo '<script>window.location.href = "teacher-accsetting.php"</script>';
}
mysqli_close($conn);
?>