<?php
    session_start();
    $email = $_POST["email"];
    $conn = new mysqli("localhost", "root", "","petek");
    $sql = "SELECT * FROM `accounts` WHERE `email` = '$email'";

    $passFromSQL = $conn->query($sql)->fetch_assoc()['password'] ?? '';
    $passFromSQL = trim(preg_replace('/\s+/', ' ', $passFromSQL));
    echo $passFromSQL;
    $conn->close();
?>