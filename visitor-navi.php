<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/visi-nav.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <section class="top-nav-bar" style="z-index:50;" id="top-nav-bar">
                <div class="left-nav" id="left-nav">
                    <a class="skillsoft-logo" href="index.php">Skill<b>Soft.</b></a>
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
                    <a id="signin-btn" class="sign-in" href="#">Sign In</a>
                    <a id="signup-btn" class="sign-up" href="#">Sign Up</a>
                </div>

            <div id="signin-modal" class="signin-modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="signin-close">&times;</span>
                    <p>Sign In</p>
                    <div class="account-login-information">
                        <!--Form to collect data when login, username and password-->
                        
                        <form class="signin-form" method="POST" id="signup">
                            <div class="selection">
                                <div class="selector-div">
                                    <input type="radio" id="roleStud" class ="role-selection" name="roleSelector" value="student" checked>
                                    <label class="selection-label" for="roleStud">Student</label>
                                </div>
                                <div class=seperateline-stu-and-tea></div>
                                <div class="selector-div">
                                    <input type="radio" id="roleTea" class ="role-selection" name="roleSelector" value="teacher">
                                    <label class="selection-label" for="roleTea">Teacher</label>
                                </div>
                            </div>
                                <div class="acc-details">
                                    <i class="fas fa-user-circle"></i>
                                    <input class="acc-username" type="text" id="student" name="log_username" placeholder="Username" required >
                                </div>
                                <div class="acc-details">
                                    <i class="fas fa-unlock-alt icon"></i>
                                    <input class="acc-password" type="password" id="password" name="log_password" placeholder="Password" required >
                                </div>
                                    <div class="showpass">
                                        <input type="checkbox" id="showPass">
                                        <label for="terms">
                                            View your password
                                        </label>
                                    </div>
                                <div class="sign-in-btn">
                                    <input type="submit" name="stud_login" value="Sign In">
                                </div>
                        </form>
                        <div class="forgot-pass">
                            <span>Forgot Password?<a href="forgot-password.php">&nbspReset your Password</a></span>
                        </div>
                        <hr class="divide-line-signin">
                        <div class="have-account">
                            <label for="have-an-account">
                                Don't have an account? <a class="signup-btn" href="#" id="signup-btn">&nbspSign Up</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="signup-modal" class="signup-modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="signup-close">&times;</span>
                    <p>Choose your account type</p>
                    <div class="signup-option">
                        <div class="left-teac-ops">
                            <a class="teac-signup-link" href="teacher-signup.php">
                                <div class="teac-card">
                                    <div class="teac-img">
                                        <img src="Images/teac-signup.png">
                                    </div>
                                    <div class="teac-title">
                                        <h2>Teacher</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="right-stud-ops">
                            <a class="stud-signup-link" href="student-signup.php">
                                <div class="stud-card">
                                    <div class="stud-img">
                                        <img src="Images/stud-signup.png">
                                    </div>
                                    <div class="stud-title">
                                        <h2>Student</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <hr class="divide-line">
                    <p class="have-an-account" style="text-align:center;">
                        Already have an account?<a href="#" class="signin-btn">&nbspSign In</a>
                    </p>
                </div>
            </div>
        </section>

        <div class="" id="dropdown-list">
            <a class="skillsoft-logo" href="index.php">SkillSoft.</a>
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
        </div>

        <!--Modal Box for Sign In-->
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

        var signinmodal = document.getElementById("signin-modal");
        var signinbtn = document.getElementById("signin-btn");
        var signinspan = document.getElementsByClassName("signin-close")[0];
        signinbtn.onclick = function() {
            signinmodal.style.display = "block";
        }
        signinspan.onclick = function() {
            signinmodal.style.display = "none";
        }

        <!--Modal Box for Sign Up-->
        var signupmodal = document.getElementById("signup-modal");
        var signupbtn = document.getElementById("signup-btn");
        var signupspan = document.getElementsByClassName("signup-close")[0];
        signupbtn.onclick = function() {
            signupmodal.style.display = "block";
        }
        signupspan.onclick = function() {
            signupmodal.style.display = "none";
        }

        //close all model and open signup model
        var signinmodalclose = document.getElementsByClassName("signup-btn")[0];
        signinmodalclose.onclick = function() {
            signinmodal.style.display = "none";
            signupmodal.style.display = "block";
        }

        //close all model and open signin model
        var signinmodalclose = document.getElementsByClassName("signin-btn")[0];
        signinmodalclose.onclick = function() {
            signupmodal.style.display = "none";
            signinmodal.style.display = "block";
        }

        window.onclick = function(event) {
        if (event.target == signupmodal) {
            signupmodal.style.display = "none";
        }
        if (event.target == signinmodal) {
            signinmodal.style.display = "none";
        }
        }

        //show and hide password jquery
        $(document).ready(function() {
            $("#showPass").change(function(){
                $(this).prop("checked") ?  $("#password").prop("type", "text") : $("#password").prop("type", "password");    
            });
        });

        </script>
    </body>
</html>


