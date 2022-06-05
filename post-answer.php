<?php
session_start();
include('config.php');

if(isset($_POST['post-answer'])) {

    $quesid = $_GET['qid'];
    $studid = $_POST['sid'];
    $answer_body = $_POST['ans-body'];
    $new_answer_body = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($answer_body));
    $answer_post_date = strval(date("Y/m/d"));

    $insertquery = "INSERT INTO answer(ans_id, ans_content, ans_date, ques_id, stud_id, teac_id) 
    VALUES(NULL, '$new_answer_body', '$answer_post_date', '$quesid', '$studid', '')";
    if (mysqli_query($conn, $insertquery)){
        echo '<script>alert("Your answer has been posted!");</script>';
        echo '<script>window.location.href = "student-ansforum.php?qid='.$quesid.'"</script>';
    } else {
        echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
        echo '<script>window.location.href = "student-ansforum.php"</script>';
    }
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "student-ansforum.php"</script>';
}
mysqli_close($conn);

?>