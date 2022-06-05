<?php
include("teacher-session.php");
include('config.php');

$log_userid = $_SESSION['teach_id'];
$retrievesql = "SELECT * FROM teacher WHERE teac_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];

if(isset($_POST['update-username'])) {
    //username name
    $new_username = $_POST['new_username'];

    $existuername = "SELECT * FROM teacher WHERE teac_username = '$new_username'";
    $result = mysqli_query($conn, $existuername);
    $username = mysqli_fetch_array($result);

    if($username > 0) {
        echo '<script>alert("Username already exists, please try a different username!")</script>';
        echo '<script>window.location.href = "teacher-prosetting.php"</script>';
    } else {
        if(!empty($new_username)){
            $sql = "UPDATE teacher SET teac_username = '$new_username' WHERE teac_id = '$tid'";
            if(mysqli_query($conn, $sql)){
            }
        }else {
            echo '<script>alert("Unable to change your username")</script>';
            echo '<script>window.location.href = "teacher-profile.php"</script>';
        }
        echo '<script>alert("Username has been change successfully")</script>';
        echo '<script>window.location.href = "teacher-profile.php"</script>';
    }
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "teacher-profile.php"</script>';
}
mysqli_close($conn);

?>