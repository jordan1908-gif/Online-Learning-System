<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-signup.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>Reset Password Page</title>
    </head>
    <body>
        <?php include("visitor-navi.php");?>
        
        <div class="container-register">
            <section class="registration-form">
                <p class="registration-title">Enter your new password!</p>
                    <form action="#" method="POST" onsubmit="return validate_form();" id="signup">
                        <div class="details">
                            <label for="password">
                                <span>Password :</span>
                            </label>
                            <div class="password-showhide">
                                <input type="password" name="stud_password" value="<?php echo $stud_password; ?>" id="password-field" minlength="8" required>
                                <button type="button"><i id="eye-pass"  onclick="showHide()" id="show-hide-pass"  class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="details">
                            <label for="confirm-password">
                                <span>Confirm Password :</span>
                            </label>
                            <div class="password-showhide">
                                <input type="password" name="stud_confirm_password" value="<?php echo $stud_confirm_password; ?>"  id="conpassword-field" minlength="8" required>
                                <button type="button"><i id="eye-conpass" onclick="showHideCon()" id="show-hide-conpass" class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="signup-button">
                            <input type="submit" value="Reset Password" name="reset-password-btn">
                        </div>
                    </form>
            </section>

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

        </div>

        <?php include("visitor-footer.php");?>
    </body>
</html>







