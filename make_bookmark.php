<?php
session_start();
require "resources/functions.php";
$link = connect();

$query = $link->prepare("INSERT INTO bookmarks VALUES(?,  ?)");
$query->bind_param("ss", $_SESSION['id'], $_GET['id']);
$query->execute();

$query->close();
$link->close();
header("Location: game.php?id=" . XSS_Helper($_GET['id']));
die();
?>