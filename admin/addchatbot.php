<?php

session_start();
require("conn.php");
$errors = array();

if (isset($_POST['submit-btn'])) {
    //Receive the input values from the student registration form
    $query = $_POST['query'];
    $reply = $_POST['reply'];
    
    $sql = "INSERT INTO chatbot(queries, replies) VALUES('$query', '$reply')";
    if (mysqli_query($conn, $sql)){
        echo '<script>alert("Successfully added new Q&As!");</script>';
        echo '<script> window.location.href="admin-chatbot.php"; </script>';
    }else {
        echo '<script>alert("Unable to add Q&As")</script>';
        echo '<script> window.location.href="admin-chatbot.php"; </script>';
}
}

?>