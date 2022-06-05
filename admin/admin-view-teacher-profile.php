<?php
session_start();

if(!isset($_SESSION['adm_username'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="admin-login-page.php"</script>';
}
include("conn.php");

header('Content-Type: text/html; charset=ISO-8859-1');

//Find the info of teacher
$tid = $_GET['tid'];
$finduser_sql = "SELECT * FROM teacher WHERE teac_id = '$tid'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);
$fname = $row['teac_first_name'];
$lname = $row['teac_last_name'];
$teac_username = $row['teac_username'];
$teac_profile = $row['teac_profile_picture'];
$join_date = strtotime($row['teac_join_date']);
$convert_join_date = date('Y/m/d', $join_date);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-course-card.css">
    <link rel="stylesheet" href="admin-teachers-profile.css">
    
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title><?php echo $fname;?> <?php echo $lname;?></title>
</head>
<body>
  <?php include("admin-nav.php")?>
        <div class="backbtn">
            <button onclick="goBack()"><i class="fas fa-caret-left"></i>Back</button>
        </div>

    <section class="top-profile">
        <div class="profile-section">
            <img id="profile-pic" src="../Images/<?php echo $teac_profile;?>" alt="profile-pic">
            <div class="user-info">
                <div class="fullname-and-edit">
                    <?php
                    //Display the total number of review
                    $verifiedsql = "SELECT * FROM teacher WHERE teac_id = '$tid'";
                    $verifiedresult = mysqli_query($conn, $verifiedsql);
                    $row = mysqli_fetch_assoc($verifiedresult);
                    $verified = $row['teac_status'];
                    
                    if($verified == 'Verified'){
                      echo '<style type = "text/css">
                              .fa-check-circle {
                                display: block;
                                color: green;
                                margin-left: 8px;
                              }
                              </style>';
                    }else{
                      echo '<style type = "text/css">
                              .fa-check-circle {
                                color: transparent;
                              }
                              </style>';
                    }
                    ?>
                    <div class="fullname">
                        <p class="first-name"><?php echo $fname;?></p>
                        <p class="last-name"><?php echo $lname;?></p>
                        &nbsp;<i class="fas fa-check-circle"></i>
                    </div>
                    <div class="change-status-button">
                        <a onclick="return confirm('Are you sure you want change the status of the teacher?')" href='admin-remove-teacher-status.php?tid=<?php echo $tid; ?>'><button class="changestatusbtn">Change Status</button></a>
                    </div>
                    
                    <div class="delete-button">
                    <a onclick="return confirm('Are you sure you want to delete?')" href='admin-deleteteacher.php?tid=<?php echo $tid;?>'><button class="deletebtn">Delete</button></a>
                    </div>
                </div>
                <p class="username">@<?php echo $teac_username;?></p>
                
                <div class="join-date">
                    <i class="far fa-calendar"></i>
                    <p class="exact-date">Joined <?php echo $convert_join_date?></p>
                </div>
                
            </div>
        </div>
    </section>
    <section class="course-from-teacher">
        <p class="course-from-p">Quizzes created by this teacher</p>
        <div class="other-course-list">
       
        </div>
    </section>

    <script>
        //back button
        function goBack() {
        window.history.back();
        }
    </script>
</body>
</html>