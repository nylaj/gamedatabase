<!DOCTYPE html>
<html lang="en">
<head>
	<title>Game Ranks - Home</title>
	<link rel="stylesheet" type="text/css" href="resources/styles.css" />
</head>

<body class="flex-container">
	<h1>Game Ranks</h1>
	<h2>A website all about video games and ranking them.</p1>
	<?php
		session_start();
		require "resources/functions.php";
		echo "<div class='flex-navbar'>";
		echo "<a href='index.php'>Home</a>";
		if (!isset($_SESSION['uname'])) { //Check to see if they are already logged in
			echo "<a href='login.php'>Login</a>";
		} else {
			echo "<a href='account.php'>" . XSS_Helper($_SESSION['uname']) . "</a>";
			echo "<a href='logout.php'>Logout</a>";
		}
		echo "<a href='games.php'>Games</a>";
		echo "</div>";

		if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) { //If they're an admin

			echo "<div class='filter'>";
			echo "<h1>Add New Game</h1>";
			echo "<form action='new_game.php' method='get'>";
			echo "<label for='title'>Game Title</label><br>" . 
			"<input type='text', id=title name=title required></input><br>" . 
			"<label for='str'>Strategy</label><br>" . 
			"<input type='radio', id=str name=radio value=str></input><br>" . 
			"<label for='rpg'>Role-Playing Game</label><br>" .
			"<input type='radio', id=rpg name=radio value=rpg></input><br>" . 
			"<label for='sim'>Simulator Game</label><br>" .
			"<input type='radio', id=sim name=radio value=sim></input><br>" . 
			"<label for='fps'>First Person Shooter</label><br>" . 
			"<input type='radio', id=fps name=radio value=fps></input><br>" . 
			"<label for='other'>Other</label><br>" . 
			"<input type='radio', id=other name=radio value=???></input><br>" .
			"<label for='rating'>Rating (1 - 99%)</label><br>" . 
			"<input type='number', id=rating name=rating min=1 max=99 required></input><br>" .
			"<label for='image'>Image</label><br>" . 
			"<input type='text', id=other name=image value=''></input><br>" .
			"<input type='submit'>" . 
			"</form>";

			echo "</div>";
			echo "<a href=resources/reset.php>Reset the Database?</a>";

		}


	?>
</body>
</html>