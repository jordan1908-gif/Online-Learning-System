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
$quizid = $_GET['quizid'];
$sql = "SELECT * FROM quiz q INNER JOIN teacher t WHERE (q.teac_id = t.teac_id) AND q.quiz_id = '$quizid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

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
    <link rel="stylesheet" href="stylesheets/stud-quizquestion.css">
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
                    <h2 id="timer-countdown"></h2>
                </div>
            </div>
            <!--display question container-->
            <div class="question-container" id="question-container">
                <form class="ques-list" method ="POST" action ="check-answer.php" id="submit">
                    <?php
                    include "config.php";
                    $sql = "SELECT *, (SELECT COUNT(quques_number) FROM quiz_question qq WHERE (qq.quiz_id = '$quizid')) AS totalquizquestion FROM quiz_question qq INNER JOIN 
                    quiz q WHERE (qq.quiz_id = q.quiz_id) AND q.quiz_id = '$quizid' ORDER BY quques_number ASC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)){
                    ?>
                    <div class="ques-info-box">
                        <div class="ques-title-info">
                            <p>
                                <?php echo $row['quques_number'];?>/<?php echo $row['totalquizquestion'];?>
                            </p>
                            <h1><?php echo $row['quques_question'];?></h1>
                        </div>
                        <div class="ques-opts-info">
                            <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'];?>">
                            <input type="hidden" name="stud_id" value="<?php echo $log_userid ;?>">
                            <input type="hidden" name="quques_id[<?php echo $row['quques_number'];?>]" value="<?php echo $row['quques_id'];?>">
                            <label class="mcq-choices">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="1">
                                <span class="checkmark"></span>
                                <p><?php echo $row['quques_choices_A'];?></p>
                            </label>
                            <label class="mcq-choices">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="2">
                                <span class="checkmark"></span>
                                <p><?php echo $row['quques_choices_B'];?></p>
                            </label>
                                <label class="mcq-choices">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="3">
                                <span class="checkmark"></span>
                                <p><?php echo $row['quques_choices_C'];?></p>
                            </label>
                            <label class="mcq-choices">
                                <input type="radio" name="answer[<?php echo $row['quques_number'];?>]" class="option" value="4">
                                <span class="checkmark"></span>
                                <p><?php echo $row['quques_choices_D'];?></p>
                            </label>     
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="btn-column">
                        <button onclick="goBack()" id="cancel-btn" type="button">Cancel</button>
                        <input type="submit" id="complete-btn" value= "Complete" name="complete-quiz">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    function goBack() {
    let text = "Are you sure you want to quit the quiz? All process will not be saved!";
    if (confirm(text) == true) {
        window.history.back();
    } else {
    }
    }
    </script>

    <?php
    include "config.php";
    $sql = "SELECT *, (SELECT COUNT(quques_number) FROM quiz_question qq WHERE (qq.quiz_id = '$quizid')) AS totalquizquestion FROM quiz_question qq INNER JOIN 
    quiz q WHERE (qq.quiz_id = q.quiz_id) AND q.quiz_id = '$quizid' ORDER BY quques_number ASC";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    ?>
    <script>
    $(document).ready(function () {
        $('#complete-btn').click(function() {
        checked = ($("input[type=radio]:checked").length >= <?php echo $row['totalquizquestion'] ?> );

        if(!checked) {
            alert("You must fill in all the questions.");
            return false;
        }

        });
    });
    </script>

    <script>
    $(document).scroll(function () {
        var y = $(this).scrollTop();
        if (y > 400) {
            $('#timer-countdown').addClass('fixed-timer');
        } else {
            $('#timer-countdown').removeClass('fixed-timer');
        }
        });
    </script>

    <?php             
    $query = "SELECT * FROM quiz WHERE quiz_id = '$quizid'";
    $timer_result = mysqli_query($conn, $query);
    if ($timer_result):
    if (mysqli_num_rows($timer_result) > 0):
    while ($res = mysqli_fetch_array($timer_result)): 
    ?>
    <script>
        function countdown( elementName, minutes, seconds )
        {
        var element, endTime, hours, mins, msLeft, time;

        function twoDigits( n )
        {
            return (n <= 9 ? "0" + n : n);
        }

        function updateTimer()
        {
        msLeft = endTime - (+new Date);
        if ( msLeft <= 0000 ) {
            alert("Times UP! Submit Quiz?");
            document.getElementById("submit").submit();
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( 
            time.getUTCSeconds() );
                setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
            }
        }
            element = document.getElementById( elementName );
            endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
            updateTimer();
        }

        countdown( "timer-countdown", <?php echo $row['quiz_timer'];?>, 0 );
    </script>
    <?php
        endwhile;
        endif;
        endif;
    ?>

    <?php include("visitor-footer.php")?>
</body>
</html>