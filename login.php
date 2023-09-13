<!DOCTYPE html>
<html lang="en">
<head>
    <title>Game Ranks - Log In</title>
    <link rel="stylesheet" type="text/css" href="resources/styles.css" />
</head>
<body class="flex-container">
    <h1 id="notify">Account</h1>
    <?php
        session_start();
        echo "<div class='flex-navbar'>";
        echo "<a href='index.php'>Home</a>";
        echo "<div>Logging in</div>";
        echo "<a href='games.php'>Games</a>";
        echo "</div>";
	?>
    <form class="flex-form" action="submit.php" method="post">
        <label for="uname">Username:</label><br>
        <input type="text" id="uname" name="uname" required><br>

        <label for="word">Password:</label><br>
        <input type="password" id="pword" name="pword" required><br>

        <input type="submit">
    </form>
</body>

</html>