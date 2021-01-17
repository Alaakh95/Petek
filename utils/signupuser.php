<?php
    require_once("db.php");

    $email = null;
    if(!empty($_POST["Email"])) {
        $email=htmlspecialchars($_POST['Email']);
    }

    $rs=mysqli_query($conn,"SELECT * FROM accounts WHERE email='$email'");
    if (mysqli_num_rows($rs)>0)
    {
        header("Location:../signup.php?status=taken");
    } else {
        // add to db
        $nickname = "";
        $phone = "";
        if(!empty($_POST["Nickname"])) {
            $nickname=htmlspecialchars($_POST['Nickname']);
        }
        if(!empty($_POST["Phone"])) {
            $phone=htmlspecialchars($_POST['Phone']);
        }
        $account = array("email"=>$email,"password"=>randomPassword(),"nickname"=>$nickname,"phone"=>$phone);
        addAccount($conn,$account);
        $conn->close();
        header("Location:../setPassword.php?Email=$email");
    }

    function addAccount($conn, $account) {
        if(!isset($account['phone'])) {
            if(!isset($account['nickname'])) {
                $sql ="INSERT INTO accounts(`email`,`password`,`nickname`,`phone`) VALUES('".$account['email']." ',' ".$account['password']."',
                ' ". " ',' ". "')";
            } else {
                $sql ="INSERT INTO accounts(`email`,`password`,`nickname`,`phone`) VALUES('".$account['email']." ',' ".$account['password']."',
                ' ".$account['nickname']." ',' ". "')";
            }
        } else {
            if(!isset($account['nickname'])) {
                $sql ="INSERT INTO accounts(`email`,`password`,`nickname`,`phone`) VALUES('".$account['email']." ',' ".$account['password']."',
                ' ". " ',' ".$account['phone']."')";
            } else {
                $sql ="INSERT INTO accounts(`email`,`password`,`nickname`,`phone`) VALUES('".$account['email']." ',' ".$account['password']."',
                ' ".$account['nickname']." ',' ".$account['phone']."')";
            }
        }
        $conn->query($sql);
    }

    function randomPassword() {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()';
        $pass = array();
        $alphaLength = strlen($characters) - 1;
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $characters[$n];
        }
        return implode($pass);
    }
?>