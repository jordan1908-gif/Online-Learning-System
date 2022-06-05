<?php

session_start();
require("conn.php");
$errors = array();

if (isset($_POST['submit-btn'])) {
    //Receive the input values from the student registration form
    $adm_first_name = $_POST['adm_first_name'];
    $adm_last_name = $_POST['adm_last_name'];
    $adm_username = $_POST['adm_username'];
    $adm_email = $_POST['adm_email'];
    $adm_password = $_POST['adm_password'];
    $adm_confirm_password = $_POST['adm_confirm_password'];

    $emailQuery = "SELECT * FROM admin WHERE adm_email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s',$adm_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if($userCount > 0) {
        echo '<script>alert("Email already exists, please try a different email!");</script>';
        echo '<script>window.history.go(-1);</script>';
        return false;
    }

    $usernameQuery = "SELECT * FROM admin WHERE adm_username=? LIMIT 1";
    $stmt = $conn->prepare($usernameQuery);
    $stmt->bind_param('s',$adm_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if($userCount > 0) {
        echo '<script>alert("Username already exists, please try a different username!");</script>';
        echo '<script>window.history.go(-1);</script>';
        return false;
    }

    if ($adm_password != $adm_confirm_password) {
        echo '<script>alert("Password and Confirm Password does not match.");</script>';
        echo '<script>window.history.go(-1);</script>';
        return false;
    } 

    if (count($errors) === 0) {
        $adm_password = password_hash($adm_password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin(adm_id, adm_username, adm_password, adm_email, adm_first_name, adm_last_name) VALUES(NULL, '$adm_username', '$adm_password','$adm_email', '$adm_first_name', '$adm_last_name')";
        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Successfully added new Admin!");</script>';
            echo '<script> window.location.href="admin-mgadmin.php"; </script>';
        }else {
            echo '<script>alert("Unable to add Admin")</script>';
            echo '<script> window.location.href="admin-mgadmin.php"; </script>';
    }
}
}
?>