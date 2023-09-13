<?php
function connect(){
    $link = new mysqli("localhost", "root", "", "GameRanks");
    if  ($link->connect_errno) {
        die("Failed to connect, Reason: " . $link->connect_error);
    }
    return $link;
}

function XSS_Helper($input, $encoding = 'UTF-8') {
    return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}

?>


