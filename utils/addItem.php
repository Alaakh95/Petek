<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$itemName=$_POST['itemName'];
$amount=$_POST['amount'];
$bought=$_POST['bought'];
$email=$_POST['email'];

if(empty($amount) || !is_numeric($amount)) {
    $amount = 1;
} else if ((int)$amount <= 0) {
    $amount = 1;
} else {
    $amount = (int)$amount;
}
$sql = "INSERT INTO `items`( `item name`, `amount`, `bought`, `email`)
VALUES ('$itemName','$amount','$bought','$email')";

if ($conn->query($sql)===TRUE) {
    echo json_encode($conn->insert_id);
}else {
    echo json_encode($conn->error);
}


// end of the file
$conn->close();