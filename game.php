<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Game Ranks - Game Entry</title>
        <link rel="stylesheet" type="text/css" href="resources/styles.css" />
    </head>
    <body class="flex-game">
        <?php
            require "resources/functions.php";
            session_start();

            echo "<div id=gamebar class='flex-navbar'>";
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
            $query = $link->prepare("SELECT * FROM games WHERE id=?");
            $query->bind_param("s", $_GET['id']);
            $query->execute();

            $result = $query->get_result();
            $info = $result->fetch_assoc();

            echo "<h1 class=game-info>" . $info['title'] ."</h1>";
            echo "<h2 class=game-info>Rating: " . $info['rating'] ."%</h2>";
            
            if (!empty($info['image'])) {
                echo "<img class=game-info src='" . XSS_Helper($info['image']) . "' alt='Image of a video game'>";
            }

            $query->close();        
            $link->close();
        ?>

        <div>
            <h3 class=game-info>Reviews</h3>
            <?php
                $link = connect();
                $result = $link->query("SELECT * FROM reviews WHERE game_id =" . $_GET['id']);
                echo "<ul id=reviews>";
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['title'] . ": ". $row['review'] . " | Score:  " . $row['rating'] . "/5.</li>";
                }

                if (isset($_SESSION['id'])) {
                    $special = $link->query("SELECT * FROM reviews WHERE game_id =" . $_GET['id'] . " AND user_id =" . $_SESSION['id']);
                    $yours = $special->fetch_assoc();
                }

                echo "</ul>";

                if (isset($_SESSION['uname'])) {
                    echo "<form action='review_post.php' method='post' id=usersubmit>";
                    echo "<label for='game_id'>Game ID:</label><br>";
                    echo "<input type='number' value='". $_GET['id'] . "' id='game_id' name='game_id' required><br>";
                    echo "<label for='rating'>Rating (5/5):</label><br>";
                    if (empty($yours['rating'])) {
                        echo "<input type='number' min=1 max=5 id='rating' name='rating' required><br>";
                    } else {
                        echo "<input type='number' min=1 max=5 value='". $yours['rating'] . "' id='rating' name='rating' required><br>";
                    }
                    echo "<label for='title'>Title:</label><br>";
                    if (empty($yours['title'])) {
                        echo "<input type='text' id='title' name='title' required><br>";
                    } 
                    else {
                        echo '<input type="text" value="' . $yours['title'] . '" id="title" name="title" required><br>';
                    }
                    echo "<label for='review'>Review:</label><br>";
                    if (empty($yours['review'])) {
                        echo "<input type='text' id='review' name='review' required><br>";
                    } 
                    else {
                        echo '<input type="text" value="' . $yours['review'] . '" id="review" name="review" required><br>';
                    }
                    echo "<input type='submit'>";
                    echo "</form>";

                    $result = $link->query("SELECT * FROM bookmarks WHERE user_id = " . $_SESSION['id'] . " AND game_id = " . $_GET['id']);
                    $row = $result->fetch_assoc();
                    if (empty($row)) {
                        echo "<form>";
                        echo "<button type='button' onclick=window.location.href='make_bookmark.php?id=" . XSS_Helper($_GET['id']) . "'>Add to Bookmarks</button></form>";
                        echo "</form>";
                    }

                    $link->close();
                }
            ?>
        </div>

        
    </body>
</html>