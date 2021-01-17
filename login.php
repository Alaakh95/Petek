<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Page</title>
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
	</head>
	<?php require_once "parts/header.php"; ?>
	<?php require_once "utils/insertAccountsJSON.php"; ?>
	<body>
		<div class="container text-center">
			<?php if (isset($_GET["status"]) && $_GET["status"]=="fail"):?>
				<div class="alert alert-danger" role="alert">
					<strong>Login Failed</strong><br><small>(wrong E-mail or password)</small>
				</div>
			<?php endif;?>
			<?php if (isset($_GET["status"]) && $_GET["status"]=="showMsg"):?>
				<div class="alert alert-warning" role="alert">
					You must be logged in in order to view the page
				</div>
			<?php endif;?>
			
			<section class="pt-5">
			<div id="form" class="container">
				<h2 class="text-center">Login</h2>
				<form method="post" class="login m-auto" action="index.php">
				<!-- onsubmit="return checkLogin()" -->
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="Email">Email*</label>
								<input
									required
									type="email"
									class="form-control"
									name="Email"
									id="Email"
									placeholder="E-Mail"
									autocomplete="on"
								/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="Password">Password*</label>
								<input
									required
									type="password"
									class="form-control"
									name="Password"
									id="Password"
									placeholder="Password"
								/>
							</div>
						</div>
					</div>
					<div class="form-check">
						<label class="form-check-label" for="stayloggedin">
							<input type="checkbox" class="form-check-input" name="stayloggedin" id="stayloggedin" value="on" checked>Stay logged in
							<span class="checkmark"></span>
						</label>
					</div>
					<input type="hidden" name="loginDate" value="<?= date("d.m.Y") ;?>">
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-block">
							Submit
						</button>
					</div>
				</form>
				<table class="table table-sm text-right">
					<tr>
						<td>
							<a href="signup.php" class="">Sign up</a>
						</td>
						<td>
							<a href="#" class="forgotPwd"
								>Forgot password</a
							>
							<!-- onclick="return forgotPassword()" -->
						</td>
					</tr>
				</table>
			</div>
		</section>
		</div>


		

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="js/users.js" type="text/javascript"></script>
	</body>
</html>
