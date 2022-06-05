<?php
session_start();
include("config.php");

if(isset($_SESSION['id'])){
    $nav = "student-navi.php";
}
include($nav);

//Pagination
//Define how many results you want per page
$result_per_page = 10;

//Find out the number of results stored in the table
$sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE q.stud_id = s.stud_id";
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

//Determine number of total pages available
$number_of_pages = ceil($number_of_results/$result_per_page);
    
//Determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
}
else {
    $page = $_GET['page'];
}

//Determine the SQL LIMIT staring number for the results on the displaying page
$starting_num = ($page-1)*$result_per_page;

if (isset($_POST['search'])) {
    $search_query ="SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE q.stud_id = s.stud_id AND q.ques_title LIKE '%".$_POST['search']."%'";
    $result = executeQuery($search_query);
    $starting_num = 0;
} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT *, (SELECT COUNT(ans_id) FROM answer a WHERE (a.ques_id = q.ques_id)) AS totalanswer FROM question q INNER JOIN student s WHERE q.stud_id = s.stud_id ORDER BY RAND() LIMIT " . $starting_num . ',' . $result_per_page;
    $result = mysqli_query($conn, $sql);
}

function executeQuery($query) {
    require("config.php");
    $result = mysqli_query($conn, $query);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
    <link rel="stylesheet" href="stylesheets/question-card.css">
    <link rel="stylesheet" href="stylesheets/show-allques.css">
    <link rel="stylesheet" href="stylesheets/paginations.css">
    <title>Questions Page</title>
</head>
<body>
    <section class="show-all-ques" id="show-all-ques">
    <?php include("backBtn.php");?>
        <div class="title-and-search">
            <p class="show-ques">All Questions</p>
            <div class="search-bar">
                <form method="POST" action="show-question.php" autocomplete="off">
                    <input id="search-input" name="search" type="text" placeholder="Search question here...">
                    <input id="real-submit" type="submit" hidden>
                    <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <!--A List of Question After User Enter a Relevant Letters -->
        <div class="ques-list-group" id="show-list">

        </div>

        <div class="ques-card-list-all" id="ques-card-list-all">
            <?php
            while ($row = mysqli_fetch_array($result)){
            ?>
            <a class="ques-boxinfo" href="student-ansforum.php?qid=<?php echo $row['ques_id']; ?>">
                <div class="ques-info">
                    <h1 class="ques-title"><?php echo $row['ques_title'];?></h1>
                    <div class="comment-nums">
                        <i class="fas fa-comment-alt"></i>
                        <span><?php echo $row['totalanswer'];?></span>
                    </div>
                </div>
                <p class="ques-description">
                    <?php echo nl2br($row['ques_content']);?>
                </p>
                <div class="creator-box">
                    <div class="post-account">
                        <img src="Images/<?php echo $row['stud_profile_picture'];?>">
                    </div>
                    <div class="post-name-date">
                        <span class="postacc-name"><?php echo $row['stud_username'];?></span>
                        <span><?php echo $row['ques_post_date'];?></span>
                    </div>
                </div>
            </a>

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#search-input").keyup(function () {
                        var searchText = $(this).val();
                        if (searchText != '') {
                            $.ajax({
                                url: 'action-question.php',
                                method: 'post',
                                data: {query: searchText},
                                success: function (response) {
                                    $("#show-list").html(response);
                                }
                            });
                        } else {
                            $("#show-list").html('');
                        }
                    });
                    $(document).on('click', 'a', function () {
                        $("#search-input").val($(this).text());
                        $("#show-list").html('');

                    });
                });
            </script>
            <?php
                }
            ?>
            </div>
            <div class="page-links-div">
                <span class="page-links">Page</span>
                <?php
                //Display the links to the pages
                for ($page=1;$page<=$number_of_pages;$page++) {
                ?>
                    <a class="page-links" href="show-question.php?page=<?php echo $page;?>"><?php echo $page;?></a>

            <?php
                }
            ;?>
        
    </section>
    <?php include("visitor-footer.php")?>
</body>
</html>