<?php
session_start();
require("conn.php");

//Initializing variable

//Pagination
//Define how many results you want per page
$result_per_page = 12;

//Find out the number of results stored in the table
$sql = "SELECT * FROM course WHERE cour_category = 'Design'";
$result = executeQuery($sql);
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

if (!isset($_SESSION['page-title'])){
    $_SESSION['page-title'] = "Courses";
}

//Determine the SQL LIMIT staring number for the results on the displaying page
$starting_num = ($page-1)*$result_per_page;

if (isset($_POST['search'])) {
    $search_query ="SELECT *FROM course WHERE cour_name LIKE '%".$_POST['search']."%' AND WHERE cour_category = 'Design'";
    $result = executeQuery($search_query);
    $starting_num = 0;
} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT *,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.cour_category = 'Design') ORDER BY RAND()";
    $result = mysqli_query($conn, $sql);
}

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
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <link rel="stylesheet" href="admin-course-card.css">
    <link rel="stylesheet" href="admin-showcourse.css">
    <link rel="stylesheet" href="admin-paginations.css">
    <title>Design Courses</title>
</head>
<body>
      <?php include("admin-nav.php")?>
    <section class="show-all-course">
        <div class="title-and-search">
            <p class="show-course"><?php echo $_SESSION['page-title'];?></p>
            <div class="search-bar">
                <form method="POST" action="admin-course.php" autocomplete="off">
                    <input id="search-input" name="search" type="text" placeholder="Search courses here...">
                    <input id="real-submit" type="submit" hidden>
                    <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <!--A List of Courses Name After User Enter a Relevant Letters -->
        <div class="course-list-group" id="show-list">

        </div>
        <div class="course-card-list-all">
            <?php
                while ($row = mysqli_fetch_array($result)){
                $course_name = $row['cour_name'];
                $course_category = $row['cour_category'];
                $cover_pic = $row['cour_cover'];
                                $teac_first_name = $row['teac_first_name'];
                $teac_last_name = $row['teac_last_name'];
                if ($rating = $row['avg_rating']){
                    $rating = $row['avg_rating'];
                } else {
                    $rating = '0';
                }
            ?>
            <a class="course-link" href="admin-course-content.php?cid=<?php echo $row['cour_id']?>">
                <div class="course-card">
                    <input type="hidden" value="<?php echo $row['cour_id'];?>">
                    <img class="course-cover-pic" src="Images/<?php echo $cover_pic?>" alt="Course cover picture">
                    <p class="course-name"><?php echo $course_name?></p>
                    <div class="teacher-star-flex">
                        <p class="course-teacher"><?php echo $teac_first_name?> <?php echo $teac_last_name?></p>
                        <div class="rating-and-value">
                            <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                            <p class="rating-value"><?php echo $rating ?></p>
                        </div>
                    </div>
                    <p class="course-tag"><?php echo $course_category?></p>
                </div>
            </a>

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#search-input").keyup(function () {
                        var searchText = $(this).val();
                        if (searchText != '') {
                            $.ajax({
                                url: 'admin-action.php',
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
                <a class="page-links" href="admin-show-des-course.php?page=<?php echo $page;?>"><?php echo $page;?></a>

            <?php
                }
            ;?>
        
    </section>
</body>
</html>