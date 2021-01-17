<?php
    require_once("db.php");

    $email = null;
    if(!empty($_POST["Email"])) {
        $email = htmlspecialchars($_POST['Email']);
    }
    $newPassword = null;
    if(!empty($_POST["Password"])) {
        $newPassword = htmlspecialchars($_POST['Password']);
    }

    $sql = "UPDATE accounts SET password='$newPassword' WHERE email='$email'";
    $conn->query($sql);
    $conn->close();
    header("Location:../login.php");
?>