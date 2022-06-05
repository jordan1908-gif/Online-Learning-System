<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];
$retrievesql = "SELECT * FROM student WHERE stud_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];

if(isset($_POST['update-name'])) {
    //first name
    $new_fname = $_POST['new_fname'];
    $new_lname = $_POST['new_lname'];

    if(!empty($new_fname)){
        $sql = "UPDATE student SET stud_first_name = '$new_fname' WHERE stud_id = '$sid'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Unable to change your firstname")</script>';
        echo '<script>window.location.href = "student-prosetting.php"</script>';
    }

    if(!empty($new_lname)){
        $sql = "UPDATE student SET stud_last_name = '$new_lname' WHERE stud_id = '$sid'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Unable to change your lastname")</script>';
        echo '<script>window.location.href = "student-prosetting.php"</script>';
    }
    echo '<script>alert("First and last name has been change successfully")</script>';
    echo '<script>window.location.href = "student-prosetting.php"</script>';
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "student-prosetting.php"</script>';
}
mysqli_close($conn);

?>