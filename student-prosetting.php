<?php
session_start();
include('config.php');

$log_userid = $_SESSION['id'];
$sql = "SELECT * FROM student WHERE stud_id = '$log_userid' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheets/stud-prosetting.css">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <title>Profile Setting Page</title>
    </head>
    <body>
        <?php include("student-navi.php");?>

        <div class="container-box" id="container-box">
            <?php include("backbtn.php");?>
            <div class="setting-container">
                <h1>Profile Settings</h1>
                <div class="setting-info">
                    <button id="upavatar-btn" class="avatar-1-set">
                        Update avatar
                        <i class="fas fa-caret-right"></i>
                    </button>
                    <button id="upusername-btn" class="username-2-set">
                        Update username
                        <i class="fas fa-caret-right"></i>
                    </button>
                    <button id="upname-btn" class="name-3-set">
                        Update name
                        <i class="fas fa-caret-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!--Open Update Avatar Modal-->
        <div id="avatarset-modal" class="avatarset-modal">
            <div class="modal-content">
                <form class="avatar-update-info" method = "POST" action = "update-propic.php"  enctype="multipart/form-data">
                <label>Upload Profile Picture</label>    
                <input type="file" id="real-profile" hidden="hidden" accept=".png,.jpg,.jpeg" name="new_propic">
                    <div class="picture-column">
                        <div class="upload-file">
                            <button type="button" id="custom-button-profile">Upload Image</button>
                            <span id="custom-profile-text" class="name-label">No file chosen</span>
                        </div>
                    </div>
                    <div class="button-class">
                        <button id="cancel-avatarset" type="button">Cancel</button>
                        <input type="submit" value="Save" name="update-profile">
                    </div>
                </form>
            </div>
        </div>

        <!--Open Update Username Modal-->
        <div id="usernameset-modal" class="usernameset-modal">
            <div class="modal-content">
                <form class="username-update-info" method = "POST" action = "update-username.php">
                    <label>Pick a username that's unique.</label>
                    <span id="countusername"></span>
                    <input type="text" onkeyup="countupdateusername(this.value)" autocomplete="off" value="<?php echo $row['stud_username'];?>" maxlength="30" minlength="1" name="new_username" required>

                    <div class="button-class">
                        <button id="cancel-usernameset" type="button">Cancel</button>
                        <input type="submit" value="Save" name="update-username">
                    </div>
                </form>
            </div>
        </div>

        <!--Open Update Name Modal-->
        <div id="nameset-modal" class="nameset-modal">
            <div class="modal-content">
                <form class="name-update-info" method = "POST" action = "update-name.php">
                    <label>Enter first name</label>
                    <span id="countfname"></span>
                    <input type="text" onkeyup="countupdatefname(this.value)" autocomplete="off" value="<?php echo $row['stud_first_name'];?>" maxlength="30" minlength="1" name="new_fname" required>

                    <label>Enter last name</label>
                    <span id="countlname"></span>
                    <input type="text" onkeyup="countupdatelname(this.value)" autocomplete="off" value="<?php echo $row['stud_last_name'];?>" maxlength="30" minlength="1" name="new_lname" required>

                    <div class="button-class">
                        <button id="cancel-nameset" type="button">Cancel</button>
                        <input type="submit" value="Save" name="update-name">
                    </div>
                </form>
            </div>
        </div>

        <script>
        //Avatar Modal
        var avatarsetmodal = document.getElementById("avatarset-modal");
        var avatarsetbtn = document.getElementById("upavatar-btn");
        var avatarcancelbtn = document.getElementById("cancel-avatarset");
        avatarsetbtn.onclick = function() {
            avatarsetmodal.style.display = "block";
        }
        avatarcancelbtn.onclick = function() {
            avatarsetmodal.style.display = "none";
        }

        //username Modal
        var usernamesetmodal = document.getElementById("usernameset-modal");
        var usernamesetbtn = document.getElementById("upusername-btn");
        var usernamecancelbtn = document.getElementById("cancel-usernameset");
        usernamesetbtn.onclick = function() {
            usernamesetmodal.style.display = "block";
        }
        usernamecancelbtn.onclick = function() {
            usernamesetmodal.style.display = "none";
        }

        //Name Modal
        var namesetmodal = document.getElementById("nameset-modal");
        var namesetbtn = document.getElementById("upname-btn");
        var namecancelbtn = document.getElementById("cancel-nameset");
        namesetbtn.onclick = function() {
            namesetmodal.style.display = "block";
        }
        namecancelbtn.onclick = function() {
            namesetmodal.style.display = "none";
        }

        //User click outisde the modal, close modal
        window.onclick = function(event) {
            if (event.target == avatarsetmodal) {
                avatarsetmodal.style.display = "none";
            }
            if (event.target == usernamesetmodal) {
                usernamesetmodal.style.display = "none";
            }
            if (event.target == namesetmodal) {
                namesetmodal.style.display = "none";
            }
        }
        </script>

        <!--Count the first name characters-->
        <script>
        function countupdatefname(str) {
            var length = str.length;
            document.getElementById("countfname").innerHTML = length + '/30';
        }
        </script>

        <!--Count the last name characters-->
        <script>
        function countupdatelname(str) {
            var length = str.length;
            document.getElementById("countlname").innerHTML = length + '/30';
        }
        </script>

        <!--Count the last name characters-->
        <script>
        function countupdateusername(str) {
            var length = str.length;
            document.getElementById("countusername").innerHTML = length + '/30';
        }
        </script>

        <!--Javascript to turn normal button to a upload file button-->
        <script type="text/javascript">
            const realFileBtn = document.getElementById("real-profile");
            const customBtn = document.getElementById("custom-button-profile");
            const customTxt = document.getElementById("custom-profile-text");

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

        <?php include("visitor-footer.php");?>
    </body>
</html>