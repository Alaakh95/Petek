<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$sql = "SELECT * FROM Items";
$result = $conn->query($sql);
$items = array();
while($row = $result->fetch_assoc()){
    $items[]=$row;
}
echo json_encode($items);
$conn->close();
