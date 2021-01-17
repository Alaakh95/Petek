<head>
		<title>Edit item</title>
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, shrink-to-fit=no"
			charset="utf-8"
		/>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		/>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<?php
    require_once("utils/db.php");
    $id=$_GET["id"];
    $sql = "SELECT * FROM Items WHERE id=$id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc() or die($conn->error);

    $sql = "SELECT * FROM Items WHERE id=$id";
    $email = $conn->query($sql)->fetch_assoc()['email'];
?>
<?php require_once "parts/header.php"; ?>

<body>
    <div class="container my-3 input-container">
        <form id="editItem" method="POST" action="utils/updateItem.php">
            <input type="hidden" id="Email" name="Email" value="<?php echo $email?>">
            <div class="row">
                <div class="col-md-6">
                    <label for="itemName" class="itemName" style="color:white">Item Name*: </label><br>
                    <input type="text" name="itemName" id="itemName" class="form-control itemName" placeholder=""
                        aria-describedby="helpId" value="<?=$item['item name'];?>" required>
                </div>
                <div class="col-md-6">
                    <label for="itemAmount" class="" style="color:white">Amount*: </label><br>
                    <input type="text" name="itemAmount" id="itemAmount" class="form-control" placeholder=""
                        aria-describedby="helpId" value="<?=$item['amount'];?>" required>
                </div>
            </div>
            <input type="hidden" name="id" value="<?=$item['id'];?>"/>
            <input type="submit" value="Save" class="btn mt-1 btn-primary btnSubmit">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/items.js" type="text/javascript"></script>
</body>

</html>