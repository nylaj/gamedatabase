<?php
    session_start();
    require "resources/functions.php";
    $link = connect();
    if ($query = $link->prepare("SELECT * FROM users WHERE uname = ?")) {
        $query->bind_param("s", $_POST['uname']);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        if ($result['pass'] == sha1($_POST['pword'] . $result['salt'])) {
            echo "correct";
            $_SESSION['uname'] = $result['uname'];
            $_SESSION['is_admin'] = $result['is_admin'];
            $_SESSION['id'] = $result['id'];
            header("Location: index.php");
            $query->close();
            $link->close();
            die();
        } else {
            var_dump($result);
            echo "incorrect";
            $query->close();
            $link->close();
        }
    }
?>