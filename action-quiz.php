<?php

$quiz_search_cat = $_GET['cat'];
if (isset($_POST['search'])) {
    $search_query = "SELECT *FROM quiz WHERE (quiz_category = '$quiz_search_cat') AND quiz_title LIKE '%" . $_POST['search'] . "%'";
    $result = executeQuery($search_query);
} else {
    $default_query = "SELECT *FROM quiz WHERE (quiz_category = '$quiz_search_cat')";
    $result = executeQuery($default_query);
}

function executeQuery($query) {
    $connect = mysqli_connect("localhost", "root", "", "skillsoft");
    $result = mysqli_query($connect, $query);
    return $result;
}
?>

<?php
while ($res = mysqli_fetch_array($result)): {
}
?>
    <?php
    include("config.php");
    if (isset($_POST['query'])) {
        $inputText = $_POST['query'];
        $query = "SELECT * FROM quiz WHERE (quiz_category = '$quiz_search_cat') AND quiz_title LIKE '%$inputText%' ";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                /* User Will Be Directly Transferred To The Specific Course Detail Page After Clicked */
                echo"
                    <form method='POST' action='show-quiz.php' class='listed-item'>
                    <a name='submit' class='list-group-item'>". $row['quiz_title'] . "</a>
                    </form>               
                    ";
            }
        } else {
            echo "<p class='listed-item-noresult'> No Found</p>";
        }
    }
    ?>
<?php endwhile; ?>