
<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php'; //Moet voor login_handler
require 'includes/form_handlers/login_handler.php';

?>

<html>
<head>
	<title>Social Network</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/javascript/register.js"></script>
</head>
<body>

	<?php
	//Hierdoor blijf je op log in of registratie pagina
	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document.ready(function() {
			$("#first").hide();
			$("#second").show();
			});
		</script>

		';
	}?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
			  <h1>Social Network</h1>
			  <h2>Log in or sign up here</h2>
			</div>

			<div id="first">
			<form action="register.php" method="POST">
			<input type="email" name="log_email" placeholder="Email Address" value=" <?php if(isset($_SESSION['log_email'])) {
			echo $_SESSION['log_email'];
			} ?>" required>
			<br>
			<input type="password" name="log_password" placeholder="Password">
			<br>
			<input type="submit" name="login_button" value="Login">
			<br>
			<a href="#" id="signup" class="signup">Need an account? Register here!</a>
			<?php if(in_array("Email or password not correct<br>", $error_array)) echo "Email or password not correct<br>"; ?>
			</form>
			</div>

			<div id="second">
			<form action="register.php" method="POST">
				<input type="text" name="reg_fname" placeholder="First Name" value=" <?php if(isset($_SESSION['reg_fname'])) {
					echo $_SESSION['reg_fname'];
				} ?>" required>
				<br>
				<?php if(in_array("First Name must be between 2 and 25 characters<br>", $error_array)) echo "First Name must be between 2 and 25 characters<br>"; ?>


				<input type="text" name="reg_lname" placeholder="Last Name" value=" <?php if(isset($_SESSION['reg_lname'])) {
					echo $_SESSION['reg_lname'];
				} ?>" required>
				<br>
				<?php if(in_array("Last Name must be between 2 and 25 characters<br>", $error_array)) echo "Last Name must be between 2 and 25 characters<br>"; ?>

				<input type="text" name="reg_email" placeholder="Email" value=" <?php if(isset($_SESSION['reg_email'])) {
					echo $_SESSION['reg_email'];
				} ?>" required>
				<br>

				<input type="text" name="reg_emailconfirm" placeholder="Confirm Email" value=" <?php if(isset($_SESSION['reg_emailconfirm'])) {
					echo $_SESSION['reg_emailconfirm'];
				} ?>" required>
				<br>
				<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
				 else if(in_array("Email format invalid<br>", $error_array)) echo "Email format invalid<br>";
				 else if(in_array("Email not matching<br>", $error_array)) echo "Email not matching<br>"; ?>


				<input type="text" name="reg_password" placeholder="Password" required>
				<br>
				<input type="text" name="reg_passwordconfirm" placeholder="Confirm Password" required>
				<br>
				<?php if(in_array("Passwords do not match<br>", $error_array)) echo "Passwords do not match<br>";
				 if(in_array("Password can only contain english characters<br>", $error_array)) echo "Password can only contain english characters<br>"; 
				 if(in_array("Password must be between 5 and 30 characters<br>", $error_array)) echo "Password must be between 5 and 30 characters<br>"; ?>

				<input type="submit" name="register_button" value="Register" required>
				<br>
				<?php if(in_array("<span style='color: #14C800;'>Registration complete. Welcome!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Registration complete. Welcome!</span><br>";
				?>

				<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
			 </form>
		      </div>

	</div>
</div>

</body>
</html>