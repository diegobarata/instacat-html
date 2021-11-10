<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    header("sign-in.html"); 
?>
