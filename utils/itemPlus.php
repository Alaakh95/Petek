<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$id = $_POST['id'];
$amount = $_POST['amount'] + 1;

$sql = "UPDATE Items SET amount='$amount' WHERE id=$id";

if ($conn->query($sql)===TRUE) {
    echo json_encode(1);
}else {
    echo json_encode($conn->error);
}


// end of the file
$conn->close();