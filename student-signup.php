<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-signup.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Sign Up Page</title>
    </head>
    <body>
        <?php include("visitor-navi.php");?>
        
        <div class="container-register" id="container-register">
            <section class="registration-form">
                <?php include("backbtn.php");?>
                <p class="registration-title">Create a free account now!</p>
                    <form method="POST" id="signup" onsubmit="return validate_form();">
                        <div class="details">
                            <label for="first-name">
                                <span>First Name :</span>
                            </label>
                            <input type="text" name="stud_first_name" value="<?php echo $stud_first_name; ?>" id="first-name" required>
                        </div>
                        <div class="details">
                            <label for="last-name">
                                <span>Last Name :</span>
                            </label>
                            <input type="text" name="stud_last_name" value="<?php echo $stud_last_name; ?>" id="last-name" required>
                        </div>
                        <div class="details">
                            <label for="username">
                                <span>Username :</span>
                            </label>
                            <input type="text" name="stud_username" value="<?php echo $stud_username; ?>" id="username" required>
                        </div>
                        <div class="details">
                            <label for="email">
                                <span>Email :</span>
                            </label>
                            <input type="email" name="stud_email" value="<?php echo $stud_email; ?>" id="email" required>
                        </div>
                        <div class="details">
                            <label for="password">
                                <span>Password :</span>
                            </label>
                            <div class="password-showhide">
                                <input type="password" name="stud_password"  id="password-field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                <button type="button"><i id="eye-pass"  onclick="showHide()" id="show-hide-pass"  class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div id="passwordMatch"></div>
                        <div class="details">
                            <label for="confirm-password">
                                <span>Confirm Password :</span>
                            </label>
                            <div class="password-showhide">
                                <input type="password" name="stud_confirm_password" id="conpassword-field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                <button type="button"><i id="eye-conpass" onclick="showHideCon()" id="show-hide-conpass" class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="terms-conditions">
                            <input type="checkbox" required>
                            <label for="tc">
                                Agree to <a href="visitor-term.php" target="_NEW">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="signup-button">
                            <input type="submit" value="sign up" name="stud-reg">
                        </div>
                        <div class="have-account">
                            <label for="have-an-account">
                                Already have an account? <a href="index.php">&nbspSign In</a>
                            </label>
                        </div>
                    </form>
            </section>
        </div>
        <?php include("visitor-footer.php");?>

            <script type="text/javascript">
                const passwordField = document.getElementById("password-field");
                const eyePass = document.getElementById("eye-pass");

                function showHide(){
                    if (passwordField.type === "password"){
                        passwordField.type = "text";
                        passwordField.focus();
                        eyePass.classList.remove("fa-eye");
                        eyePass.classList.toggle("fa-eye-slash");
                    } else {
                        passwordField.type = "password"
                        eyePass.classList.remove("fa-eye-slash");
                        eyePass.classList.toggle("fa-eye");
                    }
                };
            </script>

            <script type="text/javascript">
                const conpasswordField = document.getElementById("conpassword-field");
                const eyeConPass = document.getElementById("eye-conpass");
                    
                function showHideCon(){
                    if (conpasswordField.type === "password"){
                        conpasswordField.type = "text";
                        conpasswordField.focus();
                        eyeConPass.classList.remove("fa-eye");
                        eyeConPass.classList.toggle("fa-eye-slash");
                    } else {
                        conpasswordField.type = "password"
                        eyeConPass.classList.remove("fa-eye-slash");
                        eyeConPass.classList.toggle("fa-eye");
                    }
                };
            </script>

            <script>
            $(document).ready(function () {
            $("#conpassword-field").on('keyup', function(){
                var password = $("#password-field").val();
                var confirmPassword = $("#conpassword-field").val();
                if (password != confirmPassword)
                    $("#passwordMatch").html("Password does not match !").css("color","red");
                else
                    $("#passwordMatch").html("Password match !").css("color","green");
            });
            });
            </script>

            <script type="text/javascript">
                function validate_form() {

                    var createpass = document.getElementById("password-field").value;
                    var confirmpass = document.getElementById("conpassword-field").value;

                    if (createpass != confirmpass) {

                        alert("The two passwords does not match!");
                        document.getElementById("password-field").focus();
                        return false;
                    }
                    return true;
                }
            </script>
    </body>
</html>