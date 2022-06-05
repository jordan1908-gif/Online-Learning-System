<?php
session_start();
include('config.php');

$log_userid = $_SESSION['teach_id'];
$sql = "SELECT * FROM teacher WHERE teac_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sid = $row['teac_id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-setting.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <title>Account Setting Page</title>
    </head>
    <body>
        <?php include("teacher-navi.php");?>

        <div class="container-box">
            <?php include("backbtn.php");?>
            <div class="setting-container">
                <h1>Account Settings</h1>
                <div class="setting-info">
                    <button id="emailset-btn" class="email-1-set">
                        Update email
                        <i class="fas fa-caret-right"></i>
                    </button>
                    <button id="passwset-btn" class="password-2-set">
                        Update password
                        <i class="fas fa-caret-right"></i>
                    </button>
                    <button id="delaccset-btn" class="deleteacc-3-set">
                        Delete account
                        <i class="fas fa-caret-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!--Open Edit Email Modal-->
        <div id="emailset-modal" class="emailset-modal">
            <div class="modal-content">
                <form class="email-update-info" method = "POST" action = "teac-update-email.php">
                    <label>Current Email Address</label>
                    <input type="email" name="cur-email" class="input-field" value="<?php echo $row['teac_email'] ?>" readonly="">

                    <label>New Email Address</label>
                    <input type="email" name="new-email"class="input-field" required="">

                    <span>*Please retype your password to make the changes.</span>
                    <label>Password</label>
                    <input input type="password" name="password" class="input-field" required="">

                    <div class="button-class">
                        <a href="teac-accsetting.php"><button id="cancel-emailset">Cancel</button></a>
                        <input type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>

        <!--Open Edit Password Modal-->
        <div id="passwset-modal" class="passwordset-modal">
            <div class="modal-content">
                <form class="password-update-info" method = "POST" action = "teac-update-password.php">
                    <label>Current Password</label>
                    <input type="password" name="cur-pass" class="input-field" required="">

                    <span>*Your new password</span>
                    <label>New Password</label>
                    <input type="password" name="new-pass" class="input-field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="">

                    <label>Confirm New Password</label>
                    <input type="password" name="conf-pass" class="input-field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="">

                    <div class="button-class">
                        <button id="cancel-passwset">Cancel</button>
                        <input type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>

        <!--Open Delete Account Modal-->
        <div id="delaccset-modal" class="delacc-modal">
            <div class="modal-content">
                <form class="delete-account-info" method = "POST" action = "teac-delete-account.php">
                    <label>Delete Account</label>

                    <span>This will delete your account permanetly</span>
                    <p>
                    All of your account data 
                    will be deleted and you will not be able to sign in to this account. 
                    You will be logged out from this account once you click on the confirm button below.
                    </p>
                    <span>If you sure about your decision, here is the button</span>
                    <div class="button-class" style="margin-top: 20px;">
                        <a href="teacher-accsetting.php"><button id="cancel-delaccset">Cancel</button></a>
                        <input type="submit" value="Delete Account" name="delete-teac-acc">
                    </div>
                </form>
            </div>
        </div>

        <script>
        //Email Modal
        var emailsetmodal = document.getElementById("emailset-modal");
        var emailsetbtn = document.getElementById("emailset-btn");
        var emailcancelbtn = document.getElementById("cancel-emailset");
        emailsetbtn.onclick = function() {
            emailsetmodal.style.display = "block";
        }
        emailcancelbtn.onclick = function() {
            emailsetmodal.style.display = "none";
        }

        //Password Modal
        var passsetmodal = document.getElementById("passwset-modal");
        var passsetbtn = document.getElementById("passwset-btn");
        var passcancelbtn = document.getElementById("cancel-passwset");
        passsetbtn.onclick = function() {
            passsetmodal.style.display = "block";
        }
        passcancelbtn.onclick = function() {
            passsetmodal.style.display = "none";
        }

        //Delete Account Modal
        var delaccsetmodal = document.getElementById("delaccset-modal");
        var delaccsetbtn = document.getElementById("delaccset-btn");
        var delacccancelbtn = document.getElementById("cancel-delaccset");
        delaccsetbtn.onclick = function() {
            delaccsetmodal.style.display = "block";
        }
        delacccancelbtn.onclick = function() {
            delaccsetmodal.style.display = "none";
        }

        //User click outisde the modal, close modal
        window.onclick = function(event) {
            if (event.target == emailsetmodal) {
                emailsetmodal.style.display = "none";
            }
            if (event.target == passsetmodal) {
                passsetmodal.style.display = "none";
            }
            if (event.target == delaccsetmodal) {
                delaccsetmodal.style.display = "none";
            }
        }
        </script>

        
    </body>
</html>
