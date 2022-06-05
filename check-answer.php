<?php
session_start();
include ("config.php");
error_reporting(0);
ini_set('display_errors', 0);

$log_userid = $_SESSION['id'];
$quizid = $_POST['quiz_id'];

    if (isset($_POST['complete-quiz'])) {    
        //quiz id from post method 
        $quiz_id = $_POST['quiz_id'];
        $stud_id = $_POST['stud_id'];
        //question id and answer get from student quiz question.php
        $question_id = $_POST['quques_id'];
        $answer = $_POST['answer'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current_date_time = date("Y-m-d H:i:s");
    
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        /*
        foreach($question_id as $quesvalue => $ques) {
            $ans = $answer[$quesvalue];
            $insertsql = "INSERT INTO history(his_id, quiz_id, quques_id,
            quques_answer, stud_id)VALUES(NULL, '$quiz_id', '$ques','$ans','$stud_id')";
            if (mysqli_query($conn, $insertsql)){
                //echo '<script>alert("Record Added");</script>';
            } else {
                //echo '<script>alert("Error, unable to store record.");</script>';
            }
        }
        */

        //check answer and insert user choose answer and score into history table
        $sql = "SELECT *, (SELECT COUNT(quques_number) FROM quiz_question qq WHERE (qq.quiz_id = '$quizid')) AS totalquizquestion FROM quiz_question qq INNER JOIN 
        quiz q WHERE (qq.quiz_id = q.quiz_id) AND q.quiz_id = '$quizid' ORDER BY quques_number ASC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            
            foreach($question_id as $quesvalue => $ques) {
                $ans = $answer[$quesvalue];
                if($row['quques_id'] === $ques) {
                    if($row['quques_correct_answer'] === $ans) {
                        $is_right = 1;
                        $insertsql = "INSERT INTO history(his_id, quques_id, his_answer ,his_is_right, his_date_time, stud_id)VALUES(NULL, '$ques', '$ans', '$is_right', '$current_date_time', '$stud_id')";
                        if (mysqli_query($conn, $insertsql)){
                            //do nothing
                            echo '<script>location.href = "student-result.php?qid='.$quizid.'";</script>';
                        }
                    } else {
                        $is_right = 0;
                        $insertsql = "INSERT INTO history(his_id, quques_id, his_answer ,his_is_right, his_date_time, stud_id)VALUES(NULL, '$ques', '$ans', '$is_right', '$current_date_time', '$stud_id')";
                        if (mysqli_query($conn, $insertsql)){
                            //do nothing
                            echo '<script>location.href = "student-result.php?qid='.$quizid.'";</script>';
                        }
                    }
                }
            }
        }

        //Retreive data from history table and calculate the score, total score will save in the result table
        //$retrievesql = "SELECT *, (SELECT SUM(quques_score) FROM history WHERE quiz_id = '$quizid' AND his_date_time = (SELECT MAX(his_date_time) FROM history WHERE quiz_id = '$quizid')) AS totalscore FROM history";
        //$result = mysqli_query($conn, $retrievesql);
        //$row = mysqli_fetch_array($result);
        
        // this total score will save into result table
        //$totalscore = $row['totalscore'];
        //date_default_timezone_set("Asia/Kuala_Lumpur");
        //$current_date_time = date("Y-m-d H:i:s");
        //$quiz_id = $_POST['quiz_id'];
        //$stud_id = $_POST['stud_id'];

        //Save data into result table
        //$insertresult = "INSERT INTO result(res_id, res_marks, res_date_time, quiz_id, stud_id) VALUES(NULL, '$totalscore', '$current_date_time', '$quiz_id', '$stud_id')";
        //if (mysqli_query($conn, $insertresult)){
            //do nothing
            //echo $insertresult;
        //}
    } else {
        //quiz id from post method 
        $quiz_id = $_POST['quiz_id'];
        $stud_id = $_POST['stud_id'];
        //question id and answer get from student quiz question.php
        $question_id = $_POST['quques_id'];
        if (isset($_POST['answer'])) {
            $answer = $_POST['answer'];
        } else {
            $answer = 0;
        }

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current_date_time = date("Y-m-d H:i:s");
    
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        /*
        foreach($question_id as $quesvalue => $ques) {
            $ans = $answer[$quesvalue];
            $insertsql = "INSERT INTO history(his_id, quiz_id, quques_id,
            quques_answer, stud_id)VALUES(NULL, '$quiz_id', '$ques','$ans','$stud_id')";
            if (mysqli_query($conn, $insertsql)){
                //echo '<script>alert("Record Added");</script>';
            } else {
                //echo '<script>alert("Error, unable to store record.");</script>';
            }
        }
        */

        //check answer and insert user choose answer and score into history table
        $sql = "SELECT *, (SELECT COUNT(quques_number) FROM quiz_question qq WHERE (qq.quiz_id = '$quizid')) AS totalquizquestion FROM quiz_question qq INNER JOIN 
        quiz q WHERE (qq.quiz_id = q.quiz_id) AND q.quiz_id = '$quizid' ORDER BY quques_number ASC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {

            foreach($question_id as $quesvalue => $ques) {
                $ans = $answer[$quesvalue];
                    if($row['quques_id'] === $ques) {
                        if($row['quques_correct_answer'] === $ans) {
                            $is_right = 1;
                            $insertsql = "INSERT INTO history(his_id, quques_id, his_answer ,his_is_right, his_date_time, stud_id)VALUES(NULL, '$ques', '$ans', '$is_right', '$current_date_time', '$stud_id')";
                            if (mysqli_query($conn, $insertsql)){
                                //do nothing
                                echo '<script>location.href = "student-result.php?qid='.$quizid.'";</script>';
                            }
                        } else {
                            $is_right = 0;
                            if ($ans == ""){
                                $saveans = 5;
                            } else {
                                $saveans = $ans;
                            }
                            $insertsql = "INSERT INTO history(his_id, quques_id, his_answer ,his_is_right, his_date_time, stud_id)VALUES(NULL, '$ques', '$saveans', '$is_right', '$current_date_time', '$stud_id')";
                            if (mysqli_query($conn, $insertsql)){
                                //do nothing
                                echo '<script>location.href = "student-result.php?qid='.$quizid.'";</script>';
                            }
                        }
                    }
                }
            }
        }

?>