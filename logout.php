<?php
session_start();
echo "Logging out...";
unset($_SESSION['uname']);
unset($_SESSION['is_admin']);
unset($_SESSION['id']);
header("Location: index.php");
die();
?>