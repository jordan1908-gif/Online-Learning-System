<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];
$retrievesql = "SELECT * FROM student WHERE stud_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];

if(isset($_POST['update-username'])) {
    //username name
    $new_username = $_POST['new_username'];

    $existuername = "SELECT * FROM student WHERE stud_username = '$new_username'";
    $result = mysqli_query($conn, $existuername);
    $username = mysqli_fetch_array($result);

    if($username > 0) {
        echo '<script>alert("Username already exists, please try a different username!")</script>';
        echo '<script>window.location.href = "student-prosetting.php"</script>';
    } else {
        if(!empty($new_username)){
            $sql = "UPDATE student SET stud_username = '$new_username' WHERE stud_id = '$sid'";
            if(mysqli_query($conn, $sql)){
            }
        }else {
            echo '<script>alert("Unable to change your username")</script>';
            echo '<script>window.location.href = "student-prosetting.php"</script>';
        }
        echo '<script>alert("Username has been change successfully")</script>';
        echo '<script>window.location.href = "student-prosetting.php"</script>';
    }
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "student-prosetting.php"</script>';
}
mysqli_close($conn);

?>