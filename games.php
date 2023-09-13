<!DOCTYPE html>
<html>
    <head>
        <title>Game Ranks - Games</title>
        <link rel="stylesheet" type="text/css" href="resources/styles.css" />
    </head>
    <body class="flex-container">
        <h1>Game List</h1>
        <?php
            session_start();
            require "resources/functions.php";
            echo "<div id=gamebar class='flex-navbar'>";
            echo "<a href='index.php'>Home</a>";
            if (!isset($_SESSION['uname'])) { //Check to see if they are already logged in
                echo "<a href='login.php'>Login</a>";
            } else {
                echo "<a href='account.php'>" . XSS_Helper($_SESSION['uname']) . "</a>";
                echo "<a href='logout.php'>Logout</a>";
            }
            echo "<a href='games.php'>Games</a>";
            echo "</div>";

            echo "<ul>";
            $link = connect();
            if (empty($_GET)) {
                $result = $link->query("SELECT * FROM games");
                while($row = $result->fetch_assoc()) {
                    echo "<li><a href='game.php?id=" . XSS_Helper($row['id']) . "'>" . XSS_Helper($row['title']) . "</a></li>";
                }
            } else {
                if (empty($_GET['title'])) {
                    $query = $link->prepare("SELECT * FROM games WHERE genre = ?");
                    $query->bind_param("s", $_GET['radio']);
                } else if (empty($_GET['radio'])) {
                    $query = $link->prepare("SELECT * FROM games WHERE title = ?");
                    $query->bind_param("s", $_GET['title']);
                } else {
                    $query = $link->prepare("SELECT * FROM games WHERE title LIKE ? AND genre = ?");
                    $query->bind_param("ss", $_GET['title'], $_GET['radio']);
                }

                $query->execute();
                $result = $query->get_result();
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo "<li><a href='game.php?id=" . XSS_Helper($row['id']) . "'>" . XSS_Helper($row['title']) . "</a></li>";
                }
                $query->close();
            }
            $link->close();
            echo "</ul>";
        ?>

        <div class="filter">
            <h1>Filters</h1>
            <form action="games.php" method="get">
                <label for="title">Game Title</label><br>
                <input type="text", id=title name=title></input><br>

                <label for="str">Strategy</label><br>
                <input type="radio", id=str name=radio value=str></input><br>

                <label for="rpg">Role-Playing Game</label><br>
                <input type="radio", id=rpg name=radio value=rpg></input><br>

                <label for="sim">Simulator Game</label><br>
                <input type="radio", id=sim name=radio value=sim></input><br>

                <label for="fps">First Person Shooter</label><br>
                <input type="radio", id=fps name=radio value=fps></input><br>

                <label for="other">Other</label><br>
                <input type="radio", id=other name=radio value=???></input><br>

                <input type="submit">
            </form>
        </div>
    </body>

</html>