<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/teacher-signup.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>Teacher Sign Up Page</title>
    </head>
    <body>
        <?php include("visitor-navi.php");?>

        <div class="container-register" id="container-register">
            <section class="registration-form">
                <?php include("backbtn.php");?>
                <p class="registration-title">Start creating your own quiz!</p>
                    <form action="#" method="POST" onsubmit="return validate_form();" enctype="multipart/form-data" id="signup">
                        <div class="details">
                            <label for="first-name">
                                <span>First Name :</span>
                            </label>
                            <input type="text" name="teac_first_name" value="<?php echo $teac_first_name; ?>" id="first-name" required>
                        </div>
                        <div class="details">
                            <label for="last-name">
                                <span>Last Name :</span>
                            </label>
                            <input type="text" name="teac_last_name" value="<?php echo $teac_last_name; ?>" id="last-name" required>
                        </div>
                        <div class="details">
                            <label for="username">
                                <span>Username :</span>
                            </label>
                            <input type="text" name="teac_username" value="<?php echo $teac_username; ?>" id="username" required>
                        </div>
                        <div class="details">
                            <label for="email">
                                <span>Email :</span>
                            </label>
                            <input type="email" name="teac_email" value="<?php echo $teac_email; ?>" id="email" required>
                        </div>
                        <div class="details">
                            <label for="password">
                                <span>Password :</span>
                            </label>
                            <div class="password-showhide">
                                <input type="password" name="teac_password" value="<?php echo $teac_password; ?>" id="password-field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                <button type="button"><i id="eye-pass"  onclick="showHide()" id="show-hide-pass"  class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="details">
                            <label for="confirm-password">
                                <span>Confirm Password :</span>
                            </label>
                            <div class="password-showhide">
                                <input type="password" name="teac_confirm_password" value="<?php echo $teac_confirm_password; ?>" id="conpassword-field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                <button type="button"><i id="eye-conpass" onclick="showHideCon()" id="show-hide-conpass" class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="proof-des">
                            <label for="proof-edu">
                                <span>Proof of Education</span>
                            </label>
                            <p class="tr-paragraph">To get verified as a teacher on Skillsoft, the applicant must submit proof of education to prove themselves qualified to create quiz for the students.</p>
                            <input type="file" id="real-file" hidden="hidden" value="<?php echo $image; ?>" accept=".docx,.pdf" name="image" required="required">
                            <div class="flex-row upload-file">
                                <button type="button" id="custom-button">Choose File</button>
                                <span id="custom-text">No file chosen, yet. (.pdf or .docx format only)</span>
                            </div>
                        </div>
                        <div class="terms-conditions">
                            <input type="checkbox" required>
                            <label for="tc">
                                Agree to <a href="#" target="_NEW">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="signup-button">
                            <input type="submit" value="sign up" name="teach-reg">
                        </div>
                        <div class="have-account">
                            <label for="have-an-account">
                                Already have an account? <a href="#">&nbspSign In</a>
                            </label>
                        </div>
                    </form>
            </section>

            <script type="text/javascript">
                const realFileBtn = document.getElementById("real-file");
                const customBtn = document.getElementById("custom-button");
                const customTxt = document.getElementById("custom-text");

                customBtn.addEventListener("click", function(){
                    realFileBtn.click();
                });

                realFileBtn.addEventListener("change", function(){
                    if (realFileBtn.value) {
                        customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                    } else{
                        customTxt.innerHTML = "No file chosen, yet."
                    }
                });
            </script>

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