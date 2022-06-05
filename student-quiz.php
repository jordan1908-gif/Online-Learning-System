<?php
session_start();

if(!isset($_SESSION['id'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="index.php"</script>';
}
include("config.php");

$log_userid = $_SESSION['id'];
$sql = "SELECT * FROM student WHERE stud_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-quiz.css">
        <link rel="stylesheet" href="stylesheets/quiz-cards.css">
        <link rel="stylesheet" href="stylesheets/show-quiz.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Quiz Homepage</title>
    </head>
    <body>
    <?php include("student-navi.php");?>

        <div class="quiz-greetings" id="quiz-greetings">
            <span class="quiz-greetings-title">Welcome Back, <b><?php echo $row['stud_first_name'];?>&nbsp;<?php echo $row['stud_last_name'];?></b></span>
        </div>

        <div class="student-quiz-tab" id="student-quiz-tab">
            <div class="button-cat">
                <button class="tablinks" onclick="openCity(event, 'all-quiz')" id="defaultOpen">Quiz</button>
                <button class="tablinks" onclick="openCity(event, 'completed-quiz')">Completed</button>
            </div>
        </div>
        
        <div id="all-quiz" class="tabcontent">
            <div class="quiz-container">
                <div class="business-quiz-col">
                    <div class="title-btn">
                        <p>Business</p>
                        <button onclick="location.href='show-quiz.php?cat=Business'">View More</button>
                    </div>
                    <div class="quiz-box">
                        <?php
                        include("config.php");
                        $sql = "SELECT *, (SELECT COUNT(quques_id) FROM quiz_question qq WHERE (qq.quiz_id = q.quiz_id)) AS totalquestion 
                        , (SELECT COUNT(stud_id) FROM history h WHERE (h.quques_id = qq.quques_id)) AS totalplays FROM quiz q INNER JOIN quiz_question qq WHERE (qq.quiz_id = q.quiz_id) AND (q.quiz_category = 'Business') GROUP BY q.quiz_id ORDER BY RAND() LIMIT 4";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)){
                        ?>
                        <a class="quiz-link" href="student-quizquestion.php?quizid=<?php echo $row['quiz_id'];?>">
                            <div class="quiz-card">
                                <img class="quiz-cover-pic" src="Images/<?php echo $row['quiz_cover']?>" alt="Quiz cover picture">
                                <p class="quiz-title"><?php echo $row['quiz_title']?></p>
                                <div class="quiz-tag">
                                    <p class="quiz-subject"><?php echo $row['quiz_category']?></p>
                                    <p class="quiz-question"><?php echo $row['totalquestion']?>Qs</p>
                                    <p class="quiz-play"><?php echo $row['totalplays']?>plays</p>
                                </div>
                            </div>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="design-quiz-col">
                    <div class="title-btn">
                        <p>Design</p>
                        <button onclick="location.href='show-quiz.php?cat=Design'">View More</button>
                    </div>
                    <div class="quiz-box">
                        <?php
                        include("config.php");
                        $sql = "SELECT *, (SELECT COUNT(quques_id) FROM quiz_question qq WHERE (qq.quiz_id = q.quiz_id)) AS totalquestion 
                        , (SELECT COUNT(stud_id) FROM history h WHERE (h.quques_id = qq.quques_id)) AS totalplays FROM quiz q INNER JOIN quiz_question qq WHERE (qq.quiz_id = q.quiz_id) AND (q.quiz_category = 'Design') GROUP BY q.quiz_id ORDER BY RAND() LIMIT 4";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)){
                        ?>
                        <a class="quiz-link" href="student-quizquestion.php?quizid=<?php echo $row['quiz_id'];?>">
                            <div class="quiz-card">
                                <img class="quiz-cover-pic" src="Images/<?php echo $row['quiz_cover']?>" alt="Quiz cover picture">
                                <p class="quiz-title"><?php echo $row['quiz_title']?></p>
                                <div class="quiz-tag">
                                    <p class="quiz-subject"><?php echo $row['quiz_category']?></p>
                                    <p class="quiz-question"><?php echo $row['totalquestion']?>Qs</p>
                                    <p class="quiz-play"><?php echo $row['totalplays']?>plays</p>
                                </div>
                            </div>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="it-quiz-col">
                    <div class="title-btn">
                        <p>IT</p>
                        <button onclick="location.href='show-quiz.php?cat=IT'">View More</button>
                    </div>
                    <div class="quiz-box">
                        <?php
                        include("config.php");
                        $sql = "SELECT *, (SELECT COUNT(quques_id) FROM quiz_question qq WHERE (qq.quiz_id = q.quiz_id)) AS totalquestion 
                        , (SELECT COUNT(stud_id) FROM history h WHERE (h.quques_id = qq.quques_id)) AS totalplays FROM quiz q INNER JOIN quiz_question qq WHERE (qq.quiz_id = q.quiz_id) AND (q.quiz_category = 'IT') GROUP BY q.quiz_id ORDER BY RAND() LIMIT 4";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)){
                        ?>
                        <a class="quiz-link" href="student-quizquestion.php?quizid=<?php echo $row['quiz_id'];?>">
                            <div class="quiz-card">
                                <img class="quiz-cover-pic" src="Images/<?php echo $row['quiz_cover']?>" alt="Quiz cover picture">
                                <p class="quiz-title"><?php echo $row['quiz_title']?></p>
                                <div class="quiz-tag">
                                    <p class="quiz-subject"><?php echo $row['quiz_category']?></p>
                                    <p class="quiz-question"><?php echo $row['totalquestion']?>Qs</p>
                                    <p class="quiz-play"><?php echo $row['totalplays']?>plays</p>
                                </div>
                            </div>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="completed-quiz" class="tabcontent">
            <div class="complete-quiz-container">
                <div class="quiz-box">
                    <?php
                    include("config.php");
                    $sql = "SELECT *, (SELECT COUNT(quques_id) FROM quiz_question qq WHERE (qq.quiz_id = q.quiz_id)) AS totalquestion 
                    , (SELECT COUNT(stud_id) FROM history h WHERE (h.quques_id = qq.quques_id)) AS totalplays FROM quiz q INNER JOIN quiz_question qq, history h 
                    WHERE (qq.quiz_id = q.quiz_id) AND (qq.quques_id = h.quques_id) AND (h.stud_id = '$sid') GROUP BY q.quiz_id ORDER BY RAND()";               
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_array($result)){
                    ?>
                    <a class="quiz-link completed" href="student-result.php?qid=<?php echo $row['quiz_id'];?>" id="<?php echo $row['quiz_id'];?>">
                        <div class="quiz-card">
                            <img class="quiz-cover-pic" src="Images/<?php echo $row['quiz_cover']?>" alt="Quiz cover picture">
                            <p class="quiz-title"><?php echo $row['quiz_title']?></p>
                            <div class="quiz-tag">
                                <p class="quiz-subject"><?php echo $row['quiz_category']?></p>
                                <p class="quiz-question"><?php echo $row['totalquestion']?>Qs</p>
                                <p class="quiz-play"><?php echo $row['totalplays']?>plays</p>
                            </div>
                        </div>
                    </a>
                    <?php
                        }
                    } else {
                    ?>
                        <h2 style="font-family: 'Nunito'; font-style: normal; font-weight: 400; font-size: 24px; line-height: 33px; color: #50514F; margin-bottom: 200px" id="no-quiz-title">Oops seems like you didn't attempt any quiz yet!</h2>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Include jQuery - see http://jquery.com -->
        <script>
            $('.completed').on('click', function () {
                var t = (this.id);
                if(confirm("Do you want to reattempt the quiz?")){
                    $(".completed").attr("href", "student-quizquestion.php?quizid=" +t);
                }
                else{
                    return true;
                }
            });
        </script>

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

    <?php include("visitor-footer.php");?>
    </body>
</html>

