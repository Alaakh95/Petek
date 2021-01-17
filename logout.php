<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    unset($_COOKIE['Email']);
    unset($_COOKIE['Password']);
    unset($_COOKIE['loginDate']);
    setcookie('Email',$Email, time()-(60*60*24));
    setcookie('loginDate',$loginDate, time()-(60*60*24));
    header("Location: login.php");
?>