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
        <link rel="stylesheet" href="stylesheets/visi-aboutus.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>About Us Page</title>
    </head>
    <body>

        <div class="about-cover" id="about-cover">
            <img src="Images/about-cover.png">
        </div>

        <div class="about-container" id="about-container">
            <h1 class="about-title">About Us</h1>
                <span>Jump to:</span>
                <div class="jump-btn">
                    <a href="#jump-to-mission">Mission</a>
                    <a class="value-btn" href="#jump-to-values">Values</a>
                </div>
                <div class="about-content">
                    <p>
                        Skillsoft is a responsive online learning website that aims to enhance student’s learning 
                        quality from different educational backgrounds such as students from the Information Technology course, 
                        Design course, Business course and much more. The main objective of Skillsoft is to assess students’ knowledge towards a 
                        specific academic domain while having a major goal to spark interest in subjects such as information technology. Skillsoft also 
                        hopes to assist students to grasp technical concepts while preparing them for real university exams as an effort in increasing their 
                        problem solving and critical thinking skills. Skillsoft, similarly like Kahoot specializes in providing various quizzes for users to answer 
                        questions and gain new knowledge. It contains different quizzes in a multiple-choice question (MCQ) format where students would be able to choose one 
                        correct answer out of a total of four choices which are A, B, C, and D. Each quiz has a specific time limit and points would be accumulated 
                        for every question that were answered correctly within the specific quiz. Students would also be able to view their results once they have completed the quiz.
                    </p>
                </div>
                <div class="mission-content">
                    <h1 id="jump-to-mission">Mission</h1>
                    <h3>Make learning awesome!</h3>
                    <p>
                    To make learning awesome! At SkillSoft!, we are all about lifelong learning. In life, we learn new skills through curiosity and play. 
                    By combining the two, in a fun and social way, we can unlock the learning potential within all of us, no matter the subject, age or ability.
                    <br><br>
                    Unleashing this potential within every learner is what drives us, which is why we are on a mission to make learning awesome. We do this by creating 
                    engaging and impactful experiences for our users, and through our vision of building the leading learning platform in the world.
                    </p>
                </div>
                <div class="values-content">
                    <h1 id="jump-to-values">Values</h1>
                    <div class="values-column-3">
                        <div class="val-col-left">
                            <div class="col-img">
                                <img src="Images/about-us-1.png">
                            </div>
                            <span>We are playful</span>
                            <p>
                            Play is the first language we learn.
                            When we make learning fun, we make it engaging for everyone.
                            </p>
                        </div>
                        <div class="val-col-middle">
                            <div class="col-img">
                                <img src="Images/about-us-2.png">
                            </div>
                            <span>We are curious</span>
                            <p>
                            Curiosity is part of human nature, and it lies at the heart of all great endeavors. 
                            </p>
                        </div>
                        <div class="val-col-right">
                            <div class="col-img">
                                <img src="Images/about-us-3.png">
                            </div>
                            <span>We are inclusive</span>
                            <p>
                            We’re team players and SkillSoft strives to ensure that everyone has the chance to succeed.
                            </p>
                        </div>
                    </div>
                </div>
        </div>

        <?php include("visitor-footer.php");?>
    </body>
</html>