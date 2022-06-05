<?php
session_start();
include("config.php");

header('Content-Type: text/html; charset=ISO-8859-1');

$log_userid = $_SESSION['id'];
$sql = "SELECT * FROM student WHERE stud_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];
$spropic = $row['stud_profile_picture'];

$quesid = $_GET['qid'];

if(isset($_POST['delete-ques'])){	
	$sql = "DELETE FROM question WHERE ques_id = $quesid";
	if(mysqli_query($conn, $sql)){
		echo '<script>alert("Question has been deleted.")</script>';
		echo '<script>window.location.href="student-forum.php"</script>';
	}
	else{
		echo '<script>alert("Failed to delete your question")</script>';
        echo '<script>window.location.href="student-forum.php"</script>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-editforum.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title>Edit Question Page</title>
    </head>
    <body>
    <?php include("student-navi.php");?>

    <section class="answer-section" id="answer-section">
        <?php include("backBtn.php");?>
        <?php 
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
                    <div class="button" style="margin-top: 25px; margin-bottom: 250px; display: flex;">
                        <button id="editques-btn">Edit Question</button>
                        <form method="POST" action="student-editforum.php?qid=<?php echo $quesid;?>">
                            <input id="delete-btn" type="submit" value="Delete Question" name="delete-ques" onclick = "if (! confirm('Confirm Delete Question?')) { return false; }">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!--Open Add Question Modal-->
    <div id="editques-modal" class="editques-modal">
        <div class="modal-content">
            <?php 
            $sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE (q.stud_id = s.stud_id)
            AND q.ques_id = '$quesid'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $question_body = str_replace(array("&lsquo;", "\""), "'", htmlspecialchars($row['ques_content']));
            ?>
            <form class="edit-ques-info" method = "POST" action = "update-forumquestion.php">
                <label>Title</label>
                <span class="remain-title"><span id="countTitle"></span> Character(s) Remaining</span>
                <span class="description">Be specific and imagine you're asking a question to another person.</span>
                <input type="text" id="checkTitle" autocomplete="off" maxlength="100" minlength="1" name="ques-title" value="<?php echo $row['ques_title'];?>" required>

                <label>Body</label>
                <span class="remain-body"><span id="countBody"></span> Character(s) Remaining</span>
                <span class="description">Include all the information someone would need to answer your question.</span>
                <textarea name="ques-body" id="checkBody" autocomplete="off" maxlength="250" required><?php echo nl2br($row['ques_content']);?>"</textarea>
                <input type="text" name="ques_id" value="<?php echo $row['ques_id'];?>" hidden>
                <div class="button-class">
                    <button id="cancel-editques" type="button">Cancel</button>
                    <input type="submit" value="Update" name="edit-question">
                </div>
            </form>
        </div>
    </div>

        <script>
         //Question Modal
        var editquesmodal = document.getElementById("editques-modal");
        var editquesbtn = document.getElementById("editques-btn");
        var editquescanbtn = document.getElementById("cancel-editques");
        editquesbtn.onclick = function() {
            editquesmodal.style.display = "block";
        }
        editquescanbtn.onclick = function() {
            editquesmodal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == editquesmodal) {
                editquesmodal.style.display = "none";
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