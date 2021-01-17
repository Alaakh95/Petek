<?php require("db.php");?>
<?php 
header('Content-Type: application/json');
$email=$_POST['Email'];

$sql = "DELETE FROM Items WHERE email='$email'";
$conn->query($sql) or die($conn->error);

// end of the file
$conn->close();