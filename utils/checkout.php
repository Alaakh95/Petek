<?php require("db.php");?>
<?php 
header('Content-Type: application/json');

$allItems = $_POST['boughtItems'];
// getting email
$firstItemId = $allItems[0]['id'];
$sql = "SELECT * FROM Items WHERE id=$firstItemId";
$result = $conn->query($sql);
$email = "";
while($row = $result->fetch_assoc()){
    $email = $row['email'];
}
// getting history for that email
$previouslyBought = [];
$sql = "SELECT * FROM transactions_history WHERE email='$email'";
$result = $conn->query($sql) or die($conn->error);
while($row = $result->fetch_assoc()) {
    array_push($previouslyBought, $row['item name']);
}

foreach ($allItems as &$item) {
    $id = $item["id"];
    $sql = "DELETE FROM Items WHERE id=$id";
    if ($conn->query($sql)===TRUE) {
        // echo json_encode(1);
    }else {
        // echo json_encode($conn->error);
    }
    $itemName = $item['name'];
    if (!in_array($itemName, $previouslyBought)) {
        $sql = "INSERT INTO `transactions_history`(`email`, `item name`) VALUES ('$email','$itemName')";
        if ($conn->query($sql)===TRUE) {

        }else {
            // echo json_encode($conn->error);
        }
    }
}

$conn->close();