<?php
include("admin-session.php");
include('conn.php');

$log_userid = $_SESSION['adm_id'];
$new_email = $_POST['new-email'];
$pass = $_POST['password'];

$sql = "SELECT * FROM admin WHERE adm_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['adm_password'] === md5($pass)) {
    $sqlcheckemail =  "SELECT * FROM admin WHERE adm_email LIKE '$new_email'";
    $emailexists = mysqli_query($conn, $sqlcheckemail);
    if(mysqli_num_rows($emailexists) > 0) {
        echo '<script>alert("Email already exists, please try a different email!")</script>';
        //echo '<script>window.location.href = "admin-profile.php"</script>';
    } else {
        $sql = "UPDATE admin SET adm_email = '$new_email' WHERE adm_id = '$log_userid'";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Email has been change successfully")</script>';
            //echo '<script>window.location.href = "admin-profile.php"</script>';
        } else {
            echo '<script>alert("Unable to change your email")</script>';
            //echo '<script>window.location.href = "admin-profile.php"</script>';
        }
    }
} else {
echo '<script>alert("Please enter the correct password.")</script>';
//echo '<script>window.location.href = "admin-profile.php"</script>';
}
mysqli_close($conn);

?>