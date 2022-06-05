<?php

if(!isset($_SESSION)) { 
    session_start(); 
} 
include('config.php');
//Find the name of the logged user
$log_userid = $_SESSION['id'];
$finduser_sql = "SELECT * FROM student WHERE stud_id = '$log_userid'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-nav.css">
        <link rel="stylesheet" href="stylesheets/stud-logout.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="top-nav-bar" style="z-index:50;" id="top-nav-bar">
            <div class="left-nav"  id="left-nav">
                <a class="skillsoft-logo" href="student-quiz.php">Skill<b>Soft.</b></a>
                <a href="#" class="icon" id="menu-btn">
                    <i class="fa fa-bars"></i>
                </a>
                <nav>
                    <ul class="main-menu">
                        <li><a href="student-quiz.php" name="all_quiz">Quizzes <i class="fas fa-caret-down"></i></a>
                            <ul class="sub-menu" style="z-index:50;">
                                <li><a href="show-quiz.php?cat=Business">Business Quiz</a></li>
                                <li><a href="show-quiz.php?cat=Design">Design Quiz</a></li>
                                <li><a href="show-quiz.php?cat=IT">IT Quiz</a></li>
                            </ul>
                        </li>
                        <li><a href="student-forum.php">Forum</a></li>
                        <li><a href="visitor-faq.php">FAQ</a></li>
                        <li><a href="visitor-aboutus.php">About Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="right-nav" id="right-nav">
                <div id="img-column">
                    <img src="Images/<?php echo $row['stud_profile_picture'];?>" alt="profile-pic">
                </div>
                <div>
                    <ul class="my-account">
                        <li><a href="student-profile.php">My Account <i class="fas fa-caret-down"></i></a>
                            <ul class="account-sub">
                                <li><a href="student-profile.php" title="Profile">Profile</a></li>
                                <li><a href="student-accsetting.php" title="Settings">Settings</a></li> 
                                <!--<li><a href="logout.php" title="Logout">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></a></li>-->
                                <button id="logout-btn" class="logout-btn">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></button>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="" id="dropdown-list">
            <a class="skillsoft-logo" href="student-quiz.php">SkillSoft.</a>
            <ul class="main-menu">
                <li><a href="#" name="all_quiz">Quizzes <i class="fas fa-caret-down"></i></a>
                    <ul class="sub-menu" style="z-index:50;">
                        <li><a href="show-quiz.php?cat=Business">Business Quiz</a></li>
                        <li><a href="show-quiz.php?cat=Design">Design Quiz</a></li>
                        <li><a href="show-quiz.php?cat=IT">IT Quiz</a></li>
                    </ul>
                </li>
                <li><a href="student-forum.php">Forum</a></li>
                <li><a href="visitor-faq.php">FAQ</a></li>
                <li><a href="visitor-aboutus.php">About Us</a></li>
                <li><a href="#">My Account <i class="fas fa-caret-down"></i></a>
                    <ul class="sub-menu" style="z-index:50;">
                        <li><a href="student-profile.php" title="Profile">Profile</a></li>
                        <li><a href="student-accsetting.php" title="Settings">Settings</a></li> 
                        <!--<li><a href="logout.php" title="Logout">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></a></li>-->
                        <button id="logout-btn" class="logout-btn">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></button>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- The Modal -->
        <div id="logout-confirmation" class="logout-modal">
            <!-- Modal content -->
            <div class="logout-modal-content">
                <div class="logout-left">
                    <div>
                        <p class="logout-left-top">Oh no, you are leaving...</p>
                        <p class="logout-left-bottom">Are you sure?</p>
                    </div>
                    <div class="logout-no-yes">
                        <button type="button" class="logout-close">Nope</button>
                        <button type="button" onclick="location.href='student-logout.php'" class="logout-agree">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const targetDiv = document.getElementById("dropdown-list");
            const btn = document.getElementById("menu-btn");
            btn.onclick = function () {
            if (targetDiv.style.display !== "none") {
                targetDiv.style.display = "none";
            } else {
                targetDiv.style.display = "block";
            }
            };

            var logoutmodal = document.getElementById("logout-confirmation");
            var logoutbtn = document.getElementById("logout-btn");
            var logoutspan = document.getElementsByClassName("logout-close")[0];
            logoutbtn.onclick = function() {
            logoutmodal.style.display = "block";
            }

            logoutspan.onclick = function() {
            logoutmodal.style.display = "none";
            }

            window.onclick = function(event) {
            if (event.target == logoutmodal) {
                logoutmodal.style.display = "none";
            }
            }
        </script>
    </body>
</html>