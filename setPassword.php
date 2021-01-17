<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Set Password</title>
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
	<?php require_once "parts/header.php"; ?>
	<body>
		<section class="pt-5">
			<div id="form" class="container">
				<h2 class="text-center">Password</h2>
				<form
					oninput='
                    Password.setCustomValidity(Password.value != confirmPassword.value ? "Passwords do not match." : "")'
					method="post"
					action="./utils/updatePwd.php"
				>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="Password">Password*</label>
								<input
									required
									type="password"
									class="form-control"
									id="Password"
									name="Password"
									placeholder="Password"
									minlength="5"
								/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<input
									required
									type="password"
									class="form-control"
									id="confirmPassword"
									placeholder="Confirm password"
								/>
							</div>
						</div>
					</div>
					<input type="hidden" id="Email" name="Email" value="<?php echo $_GET['Email']?>">
					<div class="text-center">
						<button type="submit" class="btn btn-primary">
							Submit
						</button>
					</div>
					<table class="table table-sm text-left">
						<tr>
							<td>
								<a href="login.php" class="text-white">Go back</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</section>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
