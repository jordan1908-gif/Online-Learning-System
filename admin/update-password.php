<?php
include("admin-session.php");
include('conn.php');

$current_pass = $_POST['cur-pass'];
$new_pass = $_POST['new-pass'];
$conf_pass = $_POST['conf-pass'];

$sql = "SELECT * FROM admin WHERE adm_id = '$aid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($new_pass != $conf_pass) {
    echo '<script>alert("The password do not match. Please re-enter your password.")</script>';
    echo '<script>window.location.href="admin-profile.php"</script>';
} elseif (password_verify($current_pass, $row['adm_password'])) {
    $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
    $sql = "UPDATE admin SET adm_password = '$new_pass' WHERE adm_id= '$aid'";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Password has been change successfully.")</script>';
        echo '<script>window.location.href="admin-profile.php";</script>';
    } else {
        echo '<script>alert("Unable to change your password")</script>';
        echo '<script>window.location.href="admin-profile.php";</script>';
    } 
} else {
    echo '<script>alert("Current password does not matched. Please try again")</script>';
    echo '<script>window.location.href = "admin-profile.php"</script>';
}
mysqli_close($conn);
?>