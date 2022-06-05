<?php
session_start();
include("config.php");

if(!isset($_SESSION['id'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="index.php"</script>';
}

header('Content-Type: text/html; charset=ISO-8859-1');

$log_userid = $_SESSION['id'];
$sql = "SELECT * FROM student WHERE stud_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$stud_id = $row['stud_id'];
$stud_username = $row['stud_username'];
$stud_propic = $row['stud_profile_picture'];

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
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title>Forum Page</title>
    </head>
    <body>

    <?php include("student-navi.php");?>

        <div class="forum-greetings" id="forum-greetings">
            <span class="forum-greetings-title">Welcome to the Forum</span>
        </div>

        <div class="student-forum-tab" id="student-forum-tab">
            <div class="button-cat">
                <button class="tablinks" onclick="openCity(event, 'all-questions')" id="defaultOpen">All Questions</button>
                <button class="tablinks" onclick="openCity(event, 'my-questions')">My Questions</button>
            </div>
            <div class="ask-filter-btn">
                <button id="addques-btn">Ask Question</button>
                <button onclick="location.href='show-question.php'">View All Question</button>
            </div>
        </div>
        
        <div id="all-questions" class="tabcontent">
            <?php 
            $sql = "SELECT COUNT(ques_id) AS totalquestion FROM question";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <p class="total-questions"><?php echo $row['totalquestion'];?>/10 questions</p>
            <div class="question-container">
            <?php
            $sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE q.stud_id = s.stud_id ORDER BY ques_id DESC LIMIT 10";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
            $question_body = str_replace(array("&lsquo;","&quot;","\""), "'", htmlspecialchars($row['ques_content']));
            ?>
            <a class="ques-boxinfo" href="student-ansforum.php?qid=<?php echo $row['ques_id']; ?>">
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

        <div id="my-questions" class="tabcontent">
            <?php 
            $sql = "SELECT COUNT(ques_id) AS totalquestion FROM question WHERE stud_id = '$log_userid'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <p class="total-questions"><?php echo $row['totalquestion'];?> questions</p>
            <div class="question-container">
            <?php
            $sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q WHERE stud_id = '$log_userid' ORDER BY ques_id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
            $question_body = str_replace(array("&lsquo;", "\""), "'", htmlspecialchars($row['ques_content']));
            ?>
            <a class="ques-boxinfo" href="student-editforum.php?qid=<?php echo $row['ques_id']; ?>">
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
                        <img src="Images/<?php echo $stud_propic;?>">
                    </div>
                    <div class="post-name-date">
                        <span class="postacc-name"><?php echo $stud_username?></span>
                        <span><?php echo $row['ques_post_date'];?></span>
                    </div>
                </div>
            </a>
            <?php
                }
            } else {
            ?>
                <h2 id="no-ques-title">Oops seems like you didn't have any question yet!</h2>
            <?php 
                }
            ?>
            </div>
        </div>

        <!--Open Add Question Modal-->
        <div id="addques-modal" class="addques-modal">
            <div class="modal-content">
                <form class="add-ques-info" method = "POST" action = "post-question.php">
                    <label>Title</label>
                    <span class="remain-title"><span id="countTitle"></span> Character(s) Remaining</span>
                    <span class="description">Be specific and imagine you're asking a question to another person.</span>
                    <input type="text" id="checkTitle" autocomplete="off" maxlength="100" minlength="1" name="ques-title" required>

                    <label>Body</label>
                    <span class="remain-body"><span id="countBody"></span> Character(s) Remaining</span>
                    <span class="description">Include all the information someone would need to answer your question.</span>
                    <textarea name="ques-body"  id="checkBody" autocomplete="off" maxlength="250" required></textarea>

                    <div class="button-class">
                        <button id="cancel-addques">Cancel</button>
                        <input type="submit" value="Post" name="post-question">
                    </div>
                </form>
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

        //Question Modal
        var addquesmodal = document.getElementById("addques-modal");
        var addquesbtn = document.getElementById("addques-btn");
        var addquescanbtn = document.getElementById("cancel-addques");
        addquesbtn.onclick = function() {
            addquesmodal.style.display = "block";
        }
        addquescanbtn.onclick = function() {
            addquesmodal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == addquesmodal) {
                addquesmodal.style.display = "none";
            }
        }
        </script>

        <!--Count the title characters-->
        <script>
        var maxTitle = 100;
        $('#checkTitle').keyup(function() {
        var textlen = maxTitle - $(this).val().length;
        $('#countTitle').text(textlen);
        });
        </script>

        <!--Count the body characters-->
        <script>
        var maxBody = 250;
        $('#checkBody').keyup(function() {
        var textlen = maxBody - $(this).val().length;
        $('#countBody').text(textlen);
        });
        </script>

        <?php include("visitor-footer.php");?>
    </body>
</html>