<?php
session_start();
include('config.php');

if(isset($_POST['edit-question'])) {

    $question_title = $_POST['ques-title'];
    $question_body = $_POST['ques-body'];
    $ques_id = $_POST['ques_id'];
    $new_question_body = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($question_body));

    if(!empty($question_title)){
        $sql = "UPDATE question SET ques_title = '$question_title' WHERE ques_id = '$ques_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
        echo '<script>window.location.href = "student-editforum.php"</script>';
    }

    if(!empty($new_question_body)){
        $sql = "UPDATE question SET ques_content = '$new_question_body' WHERE ques_id = '$ques_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
        echo '<script>window.location.href = "student-editforum.php"</script>';
    }
    echo '<script>alert("Your question has been updated!");</script>';
    echo '<script>window.location.href = "student-ansforum.php?qid='.$ques_id.'"</script>';
} else {
    echo '<script>alert("Error")</script>';
    echo '<script>window.location.href = "student-editforum.php"</script>';
}
mysqli_close($conn);

?>