<?php
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
        <link rel="stylesheet" href="stylesheets/visi-nav.css">
        <link rel="stylesheet" href="stylesheets/teacher-logout.css">
        <link rel="stylesheet" href="stylesheets/stud-nav.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <title>Teacher Navigation Bar</title>
    </head>
    <body>
        <section class="top-nav-bar" style="z-index:50;">
            <div class="left-nav">
                <a class="skillsoft-logo" href="teacher-quiz.php">Skill<b>Soft.</b></a>
                <nav>
                    <ul class="main-menu">
                        <li><a href="teacher-quiz.php">Quizzes</a></li>
                        <li><a href="teacher-forum.php">Forum</a></li>
                        <li><a href="teacher-statistics.php">Statistics</a></li>
                    </ul>
                </nav>
            </div>
            <div class="right-nav">
                <div>
                    <img class="profile-circle" src="Images/<?php echo $row['teac_profile_picture'];?>" alt="Profile Picture">
                </div>
                <div>
                    <ul class="my-account">
                        <li><a href="">My Account <i class="fas fa-caret-down"></i></a>
                            <ul class="account-sub">
                                <li><a href="teacher-profile.php" title="Profile">Profile</a></li>
                                <li><a href="teacher-accsetting.php" title="Settings">Settings</a></li> 
                                <!--<li><a href="logout.php" title="Logout">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></a></li>-->
                                <button id="logout-btn" class="logout-btn">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></button>
                            </ul>
                        </li>
                    </ul>
                </div>
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
                                        <input type="checkbox" onclick="showPass()">
                                        <label for="terms">
                                             View your password
                                        </label>
                                    </div>
                                <div class="sign-in-btn">
                                    <input type="submit" name="stud_login" value="Sign In">
                                </div>
                        </form>
                        <div class="forgot-pass">
                            <span>Forgot Password?<a href="forgot_password.php">&nbspReset your Password</a></span>
                        </div>
                        <hr class="divide-line-signin">
                        <div class="have-account">
                            <label for="have-an-account">
                                Don't have an account? <a id="signup-btn" href="#">&nbspSign Up</a>
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
                        Already have an account?<a href="#">&nbspSign In</a>
                    </p>
                </div>
            </div>
        </section>

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

        <!--Modal Box for Sign In-->
        <script>
        var signinmodal = document.getElementById("signin-modal");
        var signinbtn = document.getElementById("signin-btn");
        var signinspan = document.getElementsByClassName("signin-close")[0];
        signinbtn.onclick = function() {
            signinmodal.style.display = "block";
        }

        signinspan.onclick = function() {
            signinmodal.style.display = "none";
        }
        </script>

        <!--Modal Box for Sign Up-->
        <script>
        var signupmodal = document.getElementById("signup-modal");
        var signupbtn = document.getElementById("signup-btn");
        var signupspan = document.getElementsByClassName("signup-close")[0];
        signupbtn.onclick = function() {
            signupmodal.style.display = "block";
        }

        signupspan.onclick = function() {
            signupmodal.style.display = "none";
        }

        window.onclick = function(event) {
        if (event.target == signupmodal) {
            signupmodal.style.display = "none";
        }
        if (event.target == signinmodal) {
            signinmodal.style.display = "none";
        }
        }
        </script>

        <script>
        function showPass(){
        var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
                    }
        }
        </script>
    </body>
</html>


