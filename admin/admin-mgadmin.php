<?php
include "admin-session.php";
include "conn.php";

//Retreive selected result from the table and display them on page
$sql = "SELECT * FROM admin ";
$result = mysqli_query($conn, $sql);

function executeQuery($query) {
    require("conn.php");
    $result = mysqli_query($conn, $query);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-mgadmins.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   
    <?php include('header.php') ?>
    <title>Manage Admin</title>
</head>
<body>
    <?php include("admin-nav.php")?>
    
    <div class="admin-page-container">
        <p class="admin-page-title">Admin</p>
   
                <div class="search-box">
                <form method="POST" action="admin-mgadmin.php" autocomplete="off">
                    <input id="search_text" name="search" type="text" placeholder="Enter admin ID or username">
                    <input id="real-submit" type="submit" hidden>
                    <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
                </form>

        </div>
        
            <div class="addbtn">
                <button onclick="document.getElementById('addadmin-form').style.display='block'">Add Admin</button>
            </div>

        <div class="admin-list">
            <table id="table-data" class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                 <?php while ($row =mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?php echo $row["adm_id"]; ?></td>
                            <td><?php echo $row["adm_username"]; ?></td>
                            <td><?php echo $row["adm_first_name"]; ?></td>
                            <td><?php echo $row["adm_last_name"]; ?></td>
                            <td><?php echo $row["adm_email"]; ?></td>
                            <td><a onclick="return confirm('Are you sure you want to delete?')" href='admin-deleteadmin.php?adm_id=<?php echo $row['adm_id'];?>'><button class="deletebtn">Delete</button></td>
                        </tr>
                    <?php
                        }
                    
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="admin-footer">
        <div class="foo-des">
            <p>Design and Develop by Win Yip & Jordan - FWDD Assignment</p>
        </div>
    </div>

    <div id="addadmin-form" class="modal">
        <form class="modal-content animate" action="addadmin.php" method="POST">
            <div class="container">
                <div class="form-details">
                    <h2>Add Admin</h2>
                        <div class="name-info">
                            <label class="first-name">
                                First Name :
                                <input type="text" name="adm_first_name" required>
                            </label>
                            <label class="last-name">
                                Last Name :
                                <input type="text" name="adm_last_name" required>
                            </label>
                        </div>
                        <label class="username-info">
                            Username :
                            <input type="text" name="adm_username" required>
                        </label>
                        <label class="email-info">
                            Email :
                            <input type="text" name="adm_email" required>
                        </label>
                        <label class="pass-info">
                            Password :
                            <div class="password-showhide">
                                <input type="password" name="adm_password" id="password-field" minlength="8" required>
                                <button type="button"><i id="eye-pass"  onclick="showHide()" id="show-hide-pass"  class="fas fa-eye"></i></button>
                            </div>
                        </label>
                        <label class="conpass-info">
                            Confirm Password :
                            <div class="password-showhide">
                                <input type="password" name="adm_confirm_password" id="conpassword-field" minlength="8" required>
                                <button type="button"><i id="eye-conpass" onclick="showHideCon()" id="show-hide-conpass" class="fas fa-eye"></i></button>
                            </div>
                        </label>
                    <input type="submit" class="submit-btn" value="Add Admin" name="submit-btn">
                </div>
            </div>
        </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('addadmin-form');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    <!--Javascript for the show/hide password button for password-->
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


    <!--Javascript for the show/hide password button for confirm password-->
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
        $(document).ready(function(){
            $('#table').DataTable();

            $("#search_text").keyup(function(){
                var search = $(this).val();
                $.ajax({
                    url:'admin-search.php',
                    method: 'post',
                    data:{query:search},
                    success:function(response){
                            $("#table-data").html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>