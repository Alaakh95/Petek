<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$email = $_POST['Email'];
// echo "$email";
$sql = "SELECT * FROM transactions_history WHERE email='$email'";
$result = $conn->query($sql);
$items = array();
while($row = $result->fetch_assoc()){
    $items[]=$row['item name'];
}
echo json_encode($items);
$conn->close();
