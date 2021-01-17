<?php
    require_once("db.php");
    $filename = "./utils/accounts.json";
    $data = file_get_contents($filename);
    $accounts = json_decode($data, true);

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

    foreach ($accounts as $account) {
        $sql = "SELECT * FROM accounts";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $canAdd = TRUE;
            while($row = $result->fetch_assoc()) {
                if($row['email'] == $account['email']) {
                    $canAdd = FALSE;
                }
            }
            if($canAdd) {
                addAccount($conn, $account);
            }
        }
        else {
            addAccount($conn, $account);
        }
    }
    $conn->close();
?>