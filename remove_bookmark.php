<?php
session_start();
require "resources/functions.php";
$link = connect();

$query = $link->prepare("DELETE FROM bookmarks WHERE user_id = ? AND game_id = ?");
$query->bind_param("ss", $_SESSION['id'], $_GET['id']);
$query->execute();

$query->close();
$link->close();
header("Location: account.php");
die();
?>