<?php
session_start();
require "resources/functions.php";
$link = connect();
$link->query("DELETE FROM reviews WHERE user_id = " . $_SESSION['id'] . " AND game_id = " . $_POST['game_id']);

$query = $link->prepare("INSERT INTO reviews(user_id, game_id, title, rating, review) VALUES(?, ?, ?, ?, ?);");
$query->bind_param("iisis", $_SESSION['id'], $_POST['game_id'], $_POST['title'], $_POST['rating'], $_POST['review']);
$query->execute();
echo "Submitted!";

$query->close();
$link->close();
header("Location: game.php?id=" . XSS_Helper($_POST['game_id']));
die();
?>