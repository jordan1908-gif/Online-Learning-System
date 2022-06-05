<?php
session_start();
include("config.php");

if(isset($_SESSION['id'])){
    $nav = "student-navi.php";
} else {
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="index.php"</script>';
}
include($nav);

$log_userid = $_SESSION['id'];
//$quizid = $_GET['quizid'];
$quizid = $_GET['qid'];
$sql = "SELECT *, (SELECT COUNT(quques_id) FROM quiz_question qq WHERE qq.quiz_id = '$quizid') AS totalquestion FROM quiz q INNER JOIN teacher t WHERE (q.teac_id = t.teac_id) AND q.quiz_id = '$quizid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$totalques = $row['totalquestion'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
    <link rel="stylesheet" href="stylesheets/stud-result.css">
    <title><?php echo $row['quiz_title'];?></title>
</head>
<body>
    <section class="show-all-quiz-ques" id="show-all-quiz-ques">
    <?php include("backBtn.php");?>
        <div class="quiz-list-all">
            <div class="title-col">
                <p class="quiz-title"><?php echo $row['quiz_title'];?></p>
                <div class="create-info">
                    <p>Created By: <?php echo $row['teac_first_name'];?>&nbsp<?php echo $row['teac_last_name'];?></p>
                    <p>Created On: <?php echo $row['quiz_create_date'];?></p>
                </div>
                <div class="result-col" id="result-col">
                    <?php
                    //get score 
                    $retrievesql = "SELECT *, (SELECT COUNT(h.his_is_right) FROM quiz_question qq INNER JOIN history h WHERE (h.quques_id = qq.quques_id) AND (h.his_is_right = '1') AND (qq.quiz_id = '$quizid') AND
                    h.his_date_time = (SELECT MAX(his_date_time) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND qq.quiz_id = '$quizid')) AS 
                    totalcorrect FROM history h INNER JOIN quiz_question qq, quiz q WHERE (h.quques_id = qq.quques_id) AND (qq.quiz_id = q.quiz_id) AND (q.quiz_id = '$quizid') LIMIT 1";
                    $result = mysqli_query($conn, $retrievesql);
                    $row = mysqli_fetch_array($result);
                    $quespoint = $row['quiz_point'];
                    $score_each_ques = ($quespoint/$totalques);
                    $score = ($row['totalcorrect'] * $score_each_ques);
                    $result = mysqli_query($conn, $retrievesql);
                    $row = mysqli_fetch_array($result);
                    ?>
                    <div class="fourth-score-box">
                        <h1>Score</h1>
                        <h2><?php echo $score ;?>/<?php echo $row['quiz_point'];?></h2>
                    </div>
                    <?php
                    $correctques = "SELECT *, (SELECT COUNT(his_is_right) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND (h.his_is_right = '1') AND (qq.quiz_id = '$quizid') AND
                    h.his_date_time = (SELECT MAX(his_date_time) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND qq.quiz_id = '$quizid')) AS totalcorrect FROM history";
                    $result = mysqli_query($conn, $correctques);
                    $row = mysqli_fetch_array($result);
                    ?>
                    <div class="second-correct-box">
                        <h1>Correct</h1>
                        <h2><?php echo $row['totalcorrect'];?>/<?php echo $totalques;?></h2>
                    </div>
                    <?php
                    $incorrectques = "SELECT *, (SELECT COUNT(his_is_right) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND (h.his_is_right = '0') AND (qq.quiz_id = '$quizid') AND
                    h.his_date_time = (SELECT MAX(his_date_time) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND qq.quiz_id = '$quizid')) AS totalwrong FROM history";
                    $result = mysqli_query($conn, $incorrectques);
                    $row = mysqli_fetch_array($result);
                    ?>
                    <div class="third-incorrect-box">
                        <h1>Incorrect</h1>
                        <h2><?php echo $row['totalwrong'];?>/<?php echo $totalques;?></h2>
                    </div>
                </div>
            </div>
            <!--display wrong question container-->
            <div class="question-container" id="question-container" style="margin-bottom: 10px;">
                <p class="wrong-ques-section">Questions</p>
                <div class="ques-list" method ="POST" action ="#">
                    <?php
                    include "config.php";
                    $wrongsql = "SELECT * FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id ) AND (h.his_is_right = '0') AND h.his_date_time 
                    = (SELECT MAX(his_date_time) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND qq.quiz_id = '$quizid') AND qq.quiz_id = '$quizid'";
                    $result = mysqli_query($conn, $wrongsql);
                    while ($row = mysqli_fetch_array($result)){
                    $useranswer = $row['his_answer'];
                    $quizanswer = $row['quques_correct_answer'];

                    if($quizanswer === "1"){
                        $coranswer = $row['quques_choices_A'];
                    }
                    elseif($quizanswer === "2"){
                        $coranswer = $row['quques_choices_B'];
                    }
                    elseif($quizanswer === "3"){
                        $coranswer = $row['quques_choices_C'];
                    }
                    elseif($quizanswer === "4"){
                        $coranswer = $row['quques_choices_D'];
                    }

                    if($useranswer === "1"){
                        $wrongans = $row['quques_choices_A'];
                    }
                    elseif($useranswer === "2"){
                        $wrongans = $row['quques_choices_B'];
                    }
                    elseif($useranswer === "3"){
                        $wrongans = $row['quques_choices_C'];
                    }
                    elseif($useranswer === "4"){
                        $wrongans = $row['quques_choices_D'];
                    }
                    else {
                        $wrongans = "You didn't asnwer this question!";
                    }
                    ?>
                    <div class="ques-info-box">
                        <div class="ques-title-info">
                            <p>
                                <?php echo $row['quques_number'];?>/<?php echo $totalques;?>
                            </p>
                            <h1><?php echo $row['quques_question'];?></h1>
                        </div>
                        <div class="ques-opts-info">
                            <label class="mcq-choices correct">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="1" disabled>
                                <span class="checkmark"></span>
                                <p><?php echo $coranswer;?></p>
                            </label>
                            <label class="mcq-choices wrong">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="2" disabled>
                                <span class="checkmark"></span>
                                <p><?php echo $wrongans;?></p>
                            </label>   
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!--display wrong question container-->
            <div class="question-container">
                <div class="ques-list" method ="POST" action ="#">
                    <?php
                    include "config.php";
                    $correctsql = "SELECT * FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id ) AND (h.his_is_right = '1') AND h.his_date_time 
                    = (SELECT MAX(his_date_time) FROM history h INNER JOIN quiz_question qq WHERE (h.quques_id = qq.quques_id) AND qq.quiz_id = '$quizid') AND qq.quiz_id = '$quizid'";
                    $result = mysqli_query($conn, $correctsql);
                    while ($row = mysqli_fetch_array($result)){
                    $correct_quesid = $row['quques_id'];
                    $quizanswer = $row['quques_correct_answer'];
                    if($quizanswer === "1"){
                        $coranswer = $row['quques_choices_A'];
                    }
                    elseif($quizanswer === "2"){
                        $coranswer = $row['quques_choices_B'];
                    }
                    elseif($quizanswer === "3"){
                        $coranswer = $row['quques_choices_C'];
                    }
                    elseif($quizanswer === "4"){
                        $coranswer = $row['quques_choices_D'];
                    }
                    ?>
                    <div class="ques-info-box">
                        <div class="ques-title-info">
                            <p>
                                <?php echo $row['quques_number'];?>/<?php echo $totalques;?>
                            </p>
                            <h1><?php echo $row['quques_question'];?></h1>
                        </div>
                        <div class="ques-opts-info">
                            <label class="mcq-choices correct">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="1" disabled>
                                <span class="checkmark"></span>
                                <p><?php echo $coranswer;?></p>
                            </label>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="btn-column">
                        <button onclick="location.href='student-quiz.php'" id="cancel-btn" type="button">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("visitor-footer.php")?>
</body>
</html>