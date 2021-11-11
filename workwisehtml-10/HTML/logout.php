<?php
    include "autentica.inc";
    session_start();
    $_SESSION = array();
    session_destroy();
    header("sign-in.html"); 
?>
