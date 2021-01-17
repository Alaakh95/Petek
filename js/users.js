$(document).ready(function () {
	// forgot password
	$(document).on("click", ".forgotPwd", function () {
		var email = document.getElementById("Email").value;
		if (email.length > 0) {
			$.post("./utils/getPwd.php", { email: email }, function (result) {
				if (result != null) {
					alert("Password is: " + result);
				} else {
					alert("Invalid E-mail.");
				}
			});
		} else {
			alert("Enter the e-mail.");
		}
	});
});
