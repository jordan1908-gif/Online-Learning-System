<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-nav.css">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section class="top-nav-bar">
        <div class="left-nav">
            <a id="learneasy-logo" href="admin-home.php"><img src="Images/Learneasy-top-logo.png" alt=""></a>
            <nav>
                <ul class="main-menu">
                    <li><a href="admin-home.php">Dashboard&nbsp;</a>
                    </li>
                    <li><a href="#">Manage User&nbsp;<i class="fas fa-caret-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="admin-mgstudent.php">Manage Student</a></li>
                            <li><a href="admin-mgteacher.php">Manage Teacher</a></li>
                            <li><a href="admin-mgadmin.php">Manage Admin</a></li>
                        </ul>
                    </li>
                    <li><a href="admin-quiz.php">Manage Quiz&nbsp;</a>
                    <li><a href="admin-chatbot.php">Manage Chatbot&nbsp;</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="right-nav">
            <div>
                <ul class="my-account">
                    <li><a href="">My Account <i class="fas fa-caret-down"></i></a>
                        <ul class="account-sub">
                            <li><a href="admin-logout.php">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>