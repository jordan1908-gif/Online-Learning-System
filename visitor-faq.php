<?php

session_start(); 

if(isset($_SESSION['id'])){
    include("student-navi.php");
}
else{
    include("visitor-navi.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/visi-faq.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>FAQ Page</title>
    </head>
    <body>

        <div class="faq-title" id="faq-title">
            <p>How can we help you?</p>
        </div>

        <div class="faq-help" id="faq-help">
            <div class="faq-box">
                <div class="account-setup">
                    <i class="fas fa-user"></i>
                    <h1>Account Setup</h1>
                    <h2>Get started on <br>SkillSoft</h2>
                    <div class="overlay">
                        <p>Account Setup</p>
                        <div class="questions">
                            <h2><a href="#1">Create a SkillSoft Account</a></h2>
                            <h3><a href="#2">Update Account Info</a></h3>
                            <h4><a href="#3">Delete an Account</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-box">
                <div class="enrollment">
                    <i class="fas fa-layer-group"></i>
                    <h1>Join Quiz</h1>
                    <h2>Join a quiz on <br>SkillSoft</h2>
                    <div class="overlay">
                        <p>Join Quiz</p>
                        <div class="questions">
                            <h2><a href="#4">Join a Quiz</a></h2>
                            <h3><a href="#5">Search a Quiz</a></h3>
                            <h4><a href="#6">View Quiz Result</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-box">
                <div class="troubleshooting">
                    <i class="fas fa-wrench"></i>
                    <h1>General</h1>
                    <h2>Common Problems</h2>
                    <div class="overlay">
                        <p>Trouble Shooting</p>
                        <div class="questions">
                            <h2><a href="#7">Unable to Login Account</a></h2>
                            <h3><a href="#8">Can't Solve Your Issues?</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="faq-word" id="faq-word">Frequently Asked Questions</p>
        <div class="faq-container" id="faq-container">
            <div class="faq-content">
                <details id="1">
                    <summary id="faq-question">
                        <span>
                            Create a SkillSoft Account
                        </span>
                    </summary>
                        <p style="margin-top: 10px; margin-bottom: 10px; font-size: 18px;">Here are the steps to create an account with SkillSoft</p>
                        <li>1. Login to skillsoft from a browser, and click on the sign-up on the top right corner.</li>
                        <li>2. Select the type of Account best suitable to you. Types of accounts include: Student and Teacher.</li>
                        <li style="list-style-type: none;">For students, you can register as a "Student" where you can test some quiz questions.</li>
                        <li style="list-style-type: none;">For teacher, you can register as a "Teacher" to start create your own quiz!</li>
                        <li>3. Fill in all the require information.</li>
                        <li>4. Click on "Sign Up" and you are all set! Cheers.</li>
                        <li>5. After that, a verification link will send to your registered email address to verify your account.</li>
                        <li>6. Once account has been verified, you can now login to your account.</li>
                </details>
                <details id="2">
                    <summary id="faq-question">
                        <span>
                            Update Account Info
                        </span>
                    </summary>
                        <p style="margin-top: 10px; margin-bottom: 10px; font-size: 18px;">Here are the steps to update your account</p>
                        <li>1. Login to your SkillSoft account, mouse over to "My Account" and click on "Profile" from the drop down list.</li>
                        <li style="list-style-type: none;">In profile settings, you can upload your profile picture, update your username and update your name.</li>
                        <li style="list-style-type: none;">In account settings, you can update you login information such as password and email address.</li>
                        <li>2. Make sure to click on "Save" to update your latest info.</li>
                </details>
                <details id="3">
                    <summary id="faq-question">
                        <span>
                            Delete an Account
                        </span>
                    </summary>
                        <li>To delete your account, just a simple click on "Delete Account" from Account Settings Page.</li>
                        <li style="list-style-type: none;">Please take note that all of your account data including running and completed quizzes, etc. 
                        will be deleted and you will not be able to sign in to this account. You will be logged out from this account once you click on the confirm button below.</li>
                </details>
                <details id="4">
                    <summary id="faq-question">
                        <span>
                            Join a Quiz
                        </span>
                    </summary>
                        <li>1. Search or browse a Quiz.</li>
                        <li style="list-style-type: none;">In SkillSoft, we provide Business, Design, IT and more quizzes for all the students.</li>
                        <li>2. Click on the quiz card, to start the quiz.</li>
                        <li>3. You will be redirected and start to attempt your quiz, a timer will notify you when the time is up.</li>
                        <li style="list-style-type: none;">Start a quiz now! Enjoy.</li>
                </details>
                <details id="5">
                    <summary id="faq-question">
                        <span>
                            Search a Quiz
                        </span>
                    </summary>
                        <li>1. To search for a quiz, just simply browse into the quiz category you looking for.</li>
                        <li style="list-style-type: none;">For examples: Design Quiz => Click on "View More" button and it will only 
                        show related quiz to you. In the search column, enter the keywords and click on the search icon. The related or similar
                        result will list down to you.</li>
                </details>
                <details id="6">
                    <summary id="faq-question">
                        <span>
                            View Quiz Result
                        </span>
                    </summary>
                        <li>1. Click on the "Complete" button once you complete a quiz.</li>
                        <li>2. You will be redirected to a result page where you can view your:</li>
                        <li style="list-style-type: none;">Ranking, Score, Correct and Incorrect information.</li>
                        <li>3. Once you have review all the questions and answers, click on "Back" to the Quiz Homepage.</li>
                </details>
                <details id="7">
                    <summary id="faq-question">
                        <span>
                            Unable to Login Account
                        </span>
                    </summary>
                        <li>1. If you unable to login with the registered information, check the steps below:</li>
                        <li style="list-style-type: none;">Make sure to click on the verification link to verify your account. </li>
                        <li style="list-style-type: none;">Still unable to login? Try to reset your password.</li>
                        <li>2. If you have try the steps above but still unable to login at the end. Please drop us an email to 
                            <a style="color: #FA8334" href="mailto: skillsofteducation@gmail.com">skillsofteducation@gmail.com</a>
                        </li>
                </details>
                <details id="8">
                    <summary id="faq-question">
                        <span>
                            Can't Solve Your Issues?
                        </span>
                    </summary>
                        <li style="list-style-type: none;">Please contact us at: <a style="color: #FA8334" href="mailto: skillsofteducation@gmail.com">skillsofteducation@gmail.com</a></li>
                </details>
            </div>
        </div>
        <?php include("visitor-footer.php");?>
    </body>
</html>