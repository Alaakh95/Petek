<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) 
        die("Connection failed: " . $conn->connect_error);
        
    $dbName = "petek";
    if (!mysqli_select_db($conn,$dbName)){
        $sql = "CREATE DATABASE $dbName";
        if ($conn->query($sql) === TRUE) {
            // echo "Database created successfully";
        }else {
            echo "Error creating database: " . $conn->error;
        }
    }

    $conn = new mysqli($servername, $username, $password,$dbName);

    $sql =" SELECT id FROM items";
    if (!$conn->query($sql)){
         $sql = "CREATE TABLE items(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         `item name` VARCHAR(999),`amount` int(6),`bought` BOOLEAN,`email` VARCHAR(999));";
        if ($conn->query($sql) === TRUE) {
            // echo "Table `items` created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }

    $sql =" SELECT email FROM accounts";
    if (!$conn->query($sql)) {
         $sql = "CREATE TABLE accounts(email VARCHAR(100) PRIMARY KEY,
         `password` VARCHAR(20), `nickname` VARCHAR(20), `phone` VARCHAR(20));";
        if ($conn->query($sql) === TRUE) {
            // echo "Table `accounts` created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }

    $sql =" SELECT email FROM transactions_history";
    if (!$conn->query($sql)) {
         $sql = "CREATE TABLE transactions_history(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, email VARCHAR(100), `item name` VARCHAR(100));";
        if ($conn->query($sql) === TRUE) {
            // echo "Table `transactions_history` created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
?>