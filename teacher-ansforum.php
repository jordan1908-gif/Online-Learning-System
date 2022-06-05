<?php
include("teacher-session.php");
require "config.php";

header('Content-Type: text/html; charset=ISO-8859-1');

$log_userid = $_SESSION['teach_id'];
$quesid = $_GET['qid'];

$sql = "SELECT * FROM teacher WHERE teac_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$tpropic = $row['teac_profile_picture'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-ansforum.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <title>Answer Forum Page</title>
    </head>
    <body>
    <?php include("teacher-navi.php");?>

    <section class="answer-section">
        <?php include("backBtn.php");?>
        <?php 
        $tid = $_SESSION['teach_id'];
        $sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE (q.stud_id = s.stud_id)
        AND q.ques_id = '$quesid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $question_body = str_replace(array("&lsquo;", "\""), "'", htmlspecialchars($row['ques_content']));
        ?>
        <section class="ans-top">
            <p class="ans-main-title">Q&A: <?php echo $row['ques_title'];?></p>

            <div class="ans-question">
                <img src="Images/<?php echo $row['stud_profile_picture'];?>" alt="">
                <div class="ans-question-owner">
                    <div class="ans-owner">
                        <p class="ans-owner-username"><?php echo $row['stud_username'];?></p>
                        <p class="ans-owner-date"><?php echo $row['ques_post_date'];?></p>
                    </div>
                    <p class="ans-question-text">
                        <?php echo nl2br($row['ques_content']);?>
                    </p>
                </div>
            </div>
            <div class="ans-post-question" style="margin-top: 25px;">
                <form action="teacher-post-reply.php?qid=<?php echo $quesid?>" method="POST">
                    
                    <div class="ans-post-poster">
                        <img src="Images/<?php echo $tpropic;?>" alt="">
                        <div class="ans-post-ta">
                            <textarea name="ans-body" id="" placeholder="Type your answer here..." required></textarea>
                            <input type="submit" class="ans-post-btn" value="Post" name="post-answer">
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <section class="ans-bottom">
            <?php 
            $sql = "SELECT COUNT(ans_id) AS totalquestion FROM answer WHERE ques_id = '$quesid'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <p class="ans-total-reply">Student Answers</p>
            <?php
            $sql = "SELECT * FROM answer a INNER JOIN student s WHERE a.ques_id = '$quesid' AND a.stud_id = s.stud_id ORDER BY a.ans_id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
            $answer_body = str_replace(array("&lsquo;", "\""), "'", htmlspecialchars($row['ans_content']));
            ?>
            <div class="ans-reply-template">
                <img src="Images/<?php echo $row['stud_profile_picture'];?>" alt="">
                <div class="ans-reply-detail">
                    <div class="ans-reply-owner">
                        <p class="ans-reply-name"><?php echo $row['stud_username'];?></p>
                        <p class="ans-reply-date"><?php echo $row['ans_date'];?></p>
                    </div>
                    <p class="ans-reply-txt">
                        <?php echo nl2br($row['ans_content']);?>
                    </p>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
                <h2 id="no-answer-title">No answer yet!</h2>
            <?php 
                }
            ?>
        </section>

        <section class="ans-bottom-teacher">
            <?php 
            $sql = "SELECT COUNT(ans_id) AS totalquestion FROM answer WHERE ques_id = '$quesid'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <p class="ans-total-reply">Teacher Answers</p>
            <?php
            $sql = "SELECT * FROM answer a INNER JOIN teacher s WHERE a.ques_id = '$quesid' AND a.teac_id = s.teac_id ORDER BY a.ans_id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
            $answer_body = str_replace(array("&lsquo;", "\""), "'", htmlspecialchars($row['ans_content']));
            ?>
            <div class="ans-reply-template">
                <img src="Images/<?php echo $row['teac_profile_picture'];?>" alt="">
                <div class="ans-reply-detail">
                    <div class="ans-reply-owner">
                        <p class="ans-reply-name">Teacher <?php echo $row['teac_username'];?></p>
                        <p class="ans-reply-date"><?php echo $row['ans_date'];?></p>
                    </div>
                    <p class="ans-reply-txt">
                        <?php echo $answer_body;?>
                    </p>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
                <h2 id="no-answer-title">No answer yet!</h2>
            <?php 
                }
            ?>
        </section>
    </section>

    
    </body>
</html>