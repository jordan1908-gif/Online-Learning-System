<?php
session_start();
include "conn.php";

if(isset($_POST['submit'])){

$adm_username = $_POST['adm_username'];
$adm_password = $_POST['adm_password'];

$sql = "SELECT * FROM admin WHERE adm_username = '$adm_username'";
$result = mysqli_query($conn, $sql);
$check = mysqli_fetch_assoc($result);

if ($check) {
    if ($check['adm_username'] === $adm_username && password_verify($adm_password, $check['adm_password'])){
            echo '<script>alert("Successfully Login");</script>';
            echo '<script> window.location.href="admin-home.php"; </script>';
            $_SESSION['adm_username'] = $adm_username;
            $_SESSION['adm_id'] = $check['adm_id'];
            echo "Hello";
        }else{
            echo '<script>alert("Username or Password Invalid!!");</script>';
            echo '<script> window.location.href="admin-login-page.php"; </script>';
            echo "Yes";
            }
        }
    }
    else {
        echo '<script>alert("Username or Password Invalid");</script>';
        echo '<script> window.location.href="admin-login-page.php"; </script>';
    }


?>

