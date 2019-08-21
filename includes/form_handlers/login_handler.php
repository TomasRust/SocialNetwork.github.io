
<?php

if(isset($_POST['login_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Email in juist format controle
	$_SESSION['log_email'] = $email; //Email toevoegen aan session
	$password = md5($_POST['log_password']); //Password ontvangen
	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'"); //In tabel users nagaan of email en password juist is
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query); //Resultaten in array toegevoegd
		$username = $row['username'];

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if(mysqli_num_rows($user_closed_query == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'") //Wanneer account is gesloten kun je inloggen en je account weer openzetten
		});

		$_SESSION['username'] = $username; //Gebruiker kan hierdoor ingelogd blijven
		header("Location: index.php"); //Wanneer gebruiker is ingelogd leiden naar index.php
	}
	else {
		array_push($error_array, "Email or password not correct<br>"); //Foutmelding wanneer niet de juiste login gegevens zijn ingevoerd
	}
}


?>
