<?php
session_start();
session_destroy();

echo '<script>alert("Successfully logout.")</script>';
echo '<script>location.href="index.php"</script>'
?>