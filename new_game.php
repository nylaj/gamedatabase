<?php
session_start();
require "resources/functions.php";

$link = connect();
$query=$link->prepare("DELETE FROM games WHERE title = ?");
$query->bind_param("s", $_GET['title']);
$query->execute();


$query=$link->prepare("REPLACE INTO games(title, image, genre, rating) VALUES(?, ?, ?, ?)");
$query->bind_param("sssi", $_GET['title'], $_GET['image'], $_GET['radio'], $_GET['rating']);
$query->execute();

$query->close();
$link->close();

header("Location: games.php");
die();
?>