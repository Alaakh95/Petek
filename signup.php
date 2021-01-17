<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sign Up</title>
		<meta
			name="viewport"
			charset="utf-8"
			content="width=device-width, initial-scale=1, shrink-to-fit=no"
		/>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		/>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

	</head>
	<?php require_once "parts/header.php"; ?>
	<?php require_once("utils/db.php"); ?>
	<body>
	<h2 class="text-center">Hello www</h2>
		<section class="pt-5">
			<div id="form" class="container text-center">
				<?php if (isset($_GET["status"]) && $_GET["status"]=="taken"):?>
					<div class="alert alert-danger" role="alert">
						<strong>Sign-Up Failed</strong><br><small>(E-mail already registered!)</small>
					</div>
				<?php endif;?>
				<h2 class="text-center">Sign up</h2>
				<!-- <form
					oninput='
					Email.setCustomValidity(Email.value != confirmEmail.value ? "E-mails do not match." : "")'
					onsubmit="return canAdd()"
					action="setPassword.php"
				> -->
				<form
					method="post"
					action="./utils/signupuser.php"
					oninput='
					Email.setCustomValidity(Email.value != confirmEmail.value ? "E-mails do not match." : "")'
				>
					<div class="row">
						<div class="col-12">
							<div id=row1 class="form-group">
								<label for="Email">Email*</label>
								<input
									required
									type="email"
									class="form-control"
									id="Email"
									name="Email"
									placeholder="E-Mail"
									v-model="Em"
								/>
							</div>
							
							<script>
								new Vue({
									el:"row1",
									data() {
										return{
											Em: "hhhhh"
										}
									}
								})
							</script>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<input
									required
									type="email"
									class="form-control"
									id="confirmEmail"
									placeholder="Confirm E-Mail"
								/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="Nickname">Nickname</label>
								<input
									type="text"
									class="form-control"
									id="Nickname"
									name="Nickname"
									placeholder="Nickname&#9;(Optional)"
								/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="Phone">Phone</label>
								<input
									type="text"
									class="form-control"
									id="Phone"
									name="Phone"
									placeholder="Phone&#9;&#9;(Optional)"
								/>
							</div>
						</div>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">
							Submit
						</button>
					</div>
					<table class="table table-sm text-left">
						<tr>
							<td>
								<a href="login.php">Go back</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</section>
		<!-- <script src="js/users.js" type="text/javascript"></script> -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
