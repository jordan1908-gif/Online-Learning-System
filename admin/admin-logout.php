<?php
session_start();
session_destroy();

echo '<script>alert("Successfully Logout.")</script>';
echo '<script>location.href="admin-login-page.php"</script>'
?>