<?php
include("teacher-session.php");
include('config.php');
//Find the name of the logged user
$log_userid = $_SESSION['teach_id'];
$finduser_sql = "SELECT * FROM teacher WHERE teac_id = '$log_userid'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-profile.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>Profile Page</title>
    </head>
    <body>
        <?php include("teacher-navi.php");?>

        <div class="container-box">
            <?php include("backbtn.php");?>
            <div class="profile-container">
                <h1>Profile</h1>
                <div class="account-info">
                    <div class="left-column-info">
                        <div class="acc-pic">
                            <img src="Images/<?php echo $row['teac_profile_picture'];?>" >
                        </div>
                        <div class="acc-detail">
                            <h2>
                                Username: <?php echo $row['teac_username'];?>
                            </h2>
                            <h2>
                                Name: <?php echo $row['teac_first_name'];?>&nbsp<?php echo $row['teac_last_name'];?>
                            </h2>
                            <h2>
                                Email: <?php echo $row['teac_email'];?>
                            </h2>
                            <button onclick="location.href='teacher-prosetting.php'">Edit Profile</button>
                        </div>
                    </div>
                    <div class="right-column-right">
                        <?php
                        $num_of_comquiz_sql = "SELECT * FROM quiz WHERE teac_id = '$tid'";
                        $resultQuiz = mysqli_query($conn, $num_of_comquiz_sql);
                        if($resultQuiz){
                            
                            $rowNum = mysqli_num_rows($resultQuiz);

                            if($rowNum){
                                $num_comquiz = $rowNum;
                            }else{
                                $num_comquiz = 0;
                            }
                            mysqli_free_result($resultQuiz);
                        }
                        ?>
                        <div class="complete-quiz-box">
                            <p class="complete-box-title">
                                Total Created Quiz
                            </p>
                            <span class="complete-box-number">
                                <?php echo $num_comquiz;?>
                            </span>
                        </div>

                        <?php
                        $num_of_question_sql = "SELECT * FROM answer WHERE teac_id = '$tid'";
                        $resultQuestion = mysqli_query($conn, $num_of_question_sql);
                        if($resultQuestion){
                            
                            $rowNum = mysqli_num_rows($resultQuestion);

                            if($rowNum){
                                $num_question = $rowNum;
                            }else{
                                $num_question = 0;
                            }
                            mysqli_free_result($resultQuestion);
                        }
                        ?>
                        <div class="question-box">
                            <p class="question-box-title">
                                Total Forum Contribution
                            </p>
                            <span class="question-box-number">
                                <?php echo $num_question;?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>