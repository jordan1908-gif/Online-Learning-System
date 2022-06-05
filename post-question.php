<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];
$retrievesql = "SELECT * FROM student WHERE stud_id = '$log_userid'";
$result = mysqli_query($conn, $retrievesql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];

if(isset($_POST['post-question'])) {

    $question_title = $_POST['ques-title'];
    $question_body = $_POST['ques-body'];
    $new_question_body = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($question_body));
    $question_post_date = strval(date("Y/m/d"));

    $insertquery = "INSERT INTO question(ques_id, ques_title, ques_content, ques_post_date, stud_id) 
    VALUES(NULL, '$question_title', '$new_question_body', '$question_post_date', '$sid')";
    if (mysqli_query($conn, $insertquery)){
        echo '<script>alert("Your question has been posted!");</script>';
        echo '<script>window.location.href = "student-forum.php"</script>';
    } else {
        echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
        echo '<script>window.location.href = "student-forum.php"</script>';
    }
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "student-forum.php"</script>';
}
mysqli_close($conn);

?>