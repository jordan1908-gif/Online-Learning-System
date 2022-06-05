<?php 
require_once 'authController.php'; 

// verify the user login token
if (isset($_GET['token'])) {
    $token = $_GET['token']; 
    verifyUser($token);
}

// verify the user login token
if (isset($_GET['password-token'])) {
    $passwordToken = $_GET['password-token']; 
    resetPassword($passwordToken);
}

if (!isset($_SESSION['id'])) {
    header('location: student-quiz.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/student-signup.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>Student Sign Up Page</title>
    </head>
    <body>
        <?php include("visitor-navi.php");?>
        
        <div class="container-register">
            <section class="registration-form">
                <div style="margin: auto; width: 60%; border: 3px solid #FA8334; border-radius: 15px; padding: 80px; margin-bottom: 100px;">
                    <label for="first-name">
                        <?php if(!$_SESSION['verified']): ?>
                        <span>Dear <?php echo $_SESSION['stud_username']; ?>, you are required to verify your account before proceeding! Sign in to your email account and click on the verification link that has been sent to you at <?php echo $_SESSION['stud_email']; ?>.</span>
                        <?php endif; ?>
                    </label>
                    <?php if($_SESSION['verified']): ?>
                        <?php echo '<script>alert("Your account has been successfully verified!");
                        window.location="student-quiz.php";
                        </script>'; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
                            
        <?php include("visitor-footer.php");?>
    </body>
</html>

