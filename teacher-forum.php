<?php 
include("teacher-session.php");
require 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-forum.css">
        <link rel="stylesheet" href="stylesheets/question-card.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <title>Forum Page</title>
    </head>
    <body>

    <?php include("teacher-navi.php");?>

        <div class="forum-greetings">
            <span class="forum-greetings-title">Welcome to the forum, <b style="color: black;"><?php echo $row['teac_first_name'];?></b>.</span>
        </div>

        <div class="student-forum-tab">
            <div class="button-cat">
                <button class="tablinks" onclick="openCity(event, 'all-questions')" id="defaultOpen">Student's Questions</button>
            </div>
            <div class="ask-filter-btn">
                <button onclick="location.href='teacher-show-question.php'">View All Questions</button>
            </div>
        </div>
        
        <div id="all-questions" class="tabcontent">
            <?php 
            $sql = "SELECT COUNT(ques_id) AS totalquestion FROM question";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <p class="total-questions">Total <b><?php echo $row['totalquestion'];?></b> questions</p>
            <div class="question-container">
            <?php
            $sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE (q.stud_id = s.stud_id)";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
            $question_body = str_replace(array("&lsquo;","&quot;","\""), "'", htmlspecialchars($row['ques_content']));
            ?>
            <a class="ques-boxinfo" href="teacher-ansforum.php?qid=<?php echo $row['ques_id']; ?>">
                <div class="ques-info">
                    <h1 class="ques-title"><?php echo $row['ques_title'];?></h1>
                    <div class="comment-nums">
                        <i class="fas fa-comment-alt"></i>
                        <span><?php echo $row['totalanswer'];?></span>
                    </div>
                </div>
                <p class="ques-description">
                    <?php echo nl2br($row['ques_content']);?>
                </p>
                <div class="creator-box">
                    <div class="post-account">
                        <img src="Images/<?php echo $row['stud_profile_picture'];?>">
                    </div>
                    <div class="post-name-date">
                        <span class="postacc-name"><?php echo $row['stud_username'];?></span>
                        <span><?php echo $row['ques_post_date'];?></span>
                    </div>
                </div>
            </a>
            <?php
                }
            }
            ?>
            <!--<?php include("pagination.php");?>-->
            </div>
        </div>

        <script>
        function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
        }
        
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        </script>
    </body>
</html>