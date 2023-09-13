<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Game Ranks - Bookmarks</title>
        <link rel='stylesheet' type='text/css' href="resources/styles.css" />
    </head>
    <body class="flex-container">
    <h1>Bookmarks</h1>
    <h2>(Click to Remove)</h2>

    <?php
        session_start();
        require "resources/functions.php";

        echo "<div class='flex-navbar'>";
		echo "<a href='index.php'>Home</a>";
		if (!isset($_SESSION['uname'])) { //Check to see if they are already logged in
			echo "<a href='login.php'>Login</a>";
		} else {
			echo "<a href='account.php'>" . $_SESSION['uname'] . "</a>";
			echo "<a href='logout.php'>Logout</a>";
		}
		echo "<a href='games.php'>Games</a>";
        echo "</div>";
        
        $link = connect();
        $result = $link->query("SELECT * FROM games WHERE games.id IN (SELECT bookmarks.game_id FROM bookmarks WHERE bookmarks.user_id = " . $_SESSION['id'] . ")");
        
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li><a href='remove_bookmark.php?id=" . XSS_Helper($row['id']) . "'>" . XSS_Helper($row['title']) . "</a></li>";
        }
        echo "</ul>";
    ?>

    </body>

</html>