<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$email=$_POST['Email'];

$sql = "DELETE FROM Items WHERE email='$email'";
$conn->query($sql) or die($conn->error);

$previouslyBought = [];
$sql = "SELECT * FROM transactions_history WHERE email='$email'";
$result = $conn->query($sql) or die($conn->error);
while($row = $result->fetch_assoc()) {
    array_push($previouslyBought, $row['item name']);
}

foreach ($previouslyBought as &$itemName) {
    $sql = "INSERT INTO `items`( `item name`, `amount`, `bought`, `email`)
    VALUES ('$itemName',1,0,'$email')";
    $conn->query($sql);
}
echo json_encode($previouslyBought);

// end of the file
$conn->close();