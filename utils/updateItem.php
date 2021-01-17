<?php
require_once('db.php');
$itemName = $_POST['itemName'];
$amount = $_POST['itemAmount'];
$email = $_POST['Email'];
$id = $_POST['id'];

$sql = "UPDATE `Items`
 SET `item name`='$itemName',`amount`='$amount',`email`='$email'
  WHERE id=$id";

if ($conn->query($sql)===TRUE) {
    header("Location:../index.php");
}else {
    $conn->error;
}


// end of the file
$conn->close();