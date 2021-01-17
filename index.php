<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Index</title>
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
		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	</head>
	<body>
		<?php
			require_once("parts/header.php");
			require_once("utils/db.php");
			session_start();
			$email= isset($_SESSION['Email'])? $_SESSION['Email']:
				(isset($_COOKIE['Email'])?
				$_COOKIE['Email']:null);

			$loginDate= isset($_SESSION['loginDate'])? $_SESSION['loginDate']:
				(isset($_COOKIE['loginDate'])?
				$_COOKIE['loginDate']:null);
			
			if(isset($_POST["Email"])) {
				$email=htmlspecialchars($_POST['Email']);
				$Password=htmlspecialchars($_POST['Password']);
				$loginDate=htmlspecialchars($_POST['loginDate']);

				$conn = new mysqli("localhost", "root", "","petek");
				$sql = "SELECT * FROM `accounts` WHERE `email` = '$email'";
				$passFromSQL = $conn->query($sql)->fetch_assoc()['password'];

				$passFromSQL = trim(preg_replace('/\s+/', ' ', $passFromSQL));
				$Password = trim(preg_replace('/\s+/', ' ', $Password));
				
				if(strcmp($passFromSQL,$Password) != 0) {
					header("Location:login.php?status=fail");
				} else { //login succsefull
					$nickname = trim($conn->query($sql)->fetch_assoc()['nickname']);
					if(!empty($nickname)) {
						echo "<h1 class='text-center'>Welcome, ".$nickname."!</h1>";
					} else {
						echo "<h1 class='text-center'>Welcome, ".explode("@",$conn->query($sql)->fetch_assoc()['email'])[0]."!</h1>";
					}
					$_SESSION['Email'] = $email;
					$_SESSION['loginDate'] = $loginDate;
					if (isset($_POST['stayloggedin'])) {
						if ($_POST['stayloggedin']=='on') {
							setcookie('Email',$email, time()+(60*60*24));
							setcookie('loginDate',$loginDate, time()+(60*60*24));
						}
					}
				}
			}
			if (is_null($email)) {
				header("Location:login.php?status=showMsg");
			}
		?>
		<p id="Email" class="text-center"><?php echo $email?></p>
		<section>
			<div class="container my-3 text-center">
				<button
					type="button"
					data-toggle="modal"
					data-target=".add-item-modal"
					class="btn btn-primary"
				>
					Add New Item
				</button>
			</div>
			<div class="add-item-modal modal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Item</h5>
							<button
								id="closeModal"
								type="button"
								class="close"
								data-dismiss="modal"
								aria-label="Close"
							>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="addItem" method="post" action="utils/insertItem.php">
								<div class="row">
									<div class="input-container col-md-6">
										<input type="hidden" id="Email" name="Email" value="<?php echo $email?>">
										<label for="itemName" class="">Item Name*: </label
										><br />
										<input
											type="text"
											name="itemName"
											id="itemName"
											class="form-control"
											placeholder="Item name"
											aria-describedby="helpId"
											required
										/>
									</div>
									<div class="col-md-6">
										<label for="itemAmount" class="">Amount: </label><br />
										<input
											type="number"
											name="itemAmount"
											id="itemAmount"
											class="form-control"
											placeholder="1"
											aria-describedby="helpId"
										/>
									</div>
								</div>
								<input type="submit" class="d-none btnSubmit" />
							</form>
						</div>
						<div id="addItemModal" class="modal-footer">
							<button type="button" class="btn btnAddItem btn-primary">
								Add Item
							</button>
							<button
								id="cancel";
								type="button"
								class="btn btn-secondary resetAddItemForm"
								data-dismiss="modal"
							>
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<table
					class="table table-bordered table-sm text-center my-4"
					id="items"
				>
					<thead class="thead">
						<tr>
							<th id="iName">Item Name</th>
							<th id="iAmount">Amount</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = "SELECT * FROM items";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {?>
							<?php  while($row = $result->fetch_assoc()):?>
								<?php if($row['email'] === $email):?>
									<?php if($row['bought'] == 1):?>
										<tr class='buy' data-id="<?= $row['id'] ;?>">
											<td class="itemName"><?php echo $row['item name'] ;?></td>
											<td class="itemAmount"><?= $row['amount'] ;?></td>
											<td>
												<a href="#" class="btnBuy">Buy</a> |
												<a href="editForm.php?id=<?= $row['id'] ;?>" class="btnEdit">Edit</a> |
												<a href="#" class="btnRemove">Remove</a> |
												<a href="#" class="btnPlus">+</a> |
												<a href="#" class="btnMinus">-</a>
											</td>
										</tr>
									<?php else:?>
										<tr data-id="<?= $row['id'] ;?>">
											<td class="itemName"><?php echo $row['item name'] ;?></td>
											<td class="itemAmount"><?= $row['amount'] ;?></td>
											<td>
												<a href="#" class="btnBuy">Buy</a> |
												<a href="editForm.php?id=<?= $row['id'] ;?>" class="btnEdit">Edit</a> |
												<a href="#" class="btnRemove">Remove</a> |
												<a href="#" class="btnPlus">+</a> |
												<a href="#" class="btnMinus">-</a>
											</td>
										</tr>
									<?php endif;?>
								<?php endif;?>
							<?php endwhile;?>
							<?php
						}
						else {
							echo "0 results";
						}
						$conn->close();
						?>
					</tbody>
				</table>
			</div>
			<div class="modal fade remove" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Are you sure?</h5>
							<button
								type="button"
								class="close"
								data-dismiss="modal"
								aria-label="Close"
							>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>You are about to delete</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btnRemoveConfirm btn-danger">
								Delete
							</button>
							<button
								type="button"
								class="btn btn-secondary"
								data-dismiss="modal"
							>
								Cancel
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="container text-center">
				<button id="newList" class="btn btn-primary">Empty list</button>
				<button id="prevBought" class="btn btn-primary">Load previously<br>bought list</button>
				<br><br>
				<button id="checkout" class="btn btn-primary" onclick="index.php">Checkout</button>
			</div>
			<br />
			<div class="container text-center"><br>
				<small style="color:white">You logged in at <?=$loginDate?></small>
			</div>
		</section>
		<a hidden id="refresh" href="index.php"></a>
		<!-- <a id="test1" href="javascript:alert('test1')">TEST1</a> -->


		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="js/sortElements.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="js/items.js" type="text/javascript"></script>
	</body>
</html>
