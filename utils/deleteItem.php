<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$id=$_POST['id'];

$sql = "DELETE FROM Items WHERE id=$id";

if ($conn->query($sql)===TRUE) {
    echo json_encode(1);
}else {
    echo json_encode($conn->error);
}


// end of the file
$conn->close();