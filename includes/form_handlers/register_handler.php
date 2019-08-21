
<?php
require 'config/config.php';

//Aanmaken van variabelen
$fname = "";
$lname = "";
$email = "";
$emailconfirm = "";
$password = "";
$passwordconfirm = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])){

	//Registratie
	//Voornaam
	$fname = strip_tags($_POST['reg_fname']); //Restricties bij het invoeren
	$fname = str_replace(' ',' ', $fname); //Spaties verwijderen
	$fname = ucfirst(strtolower($fname)); //Hoofdletter eerste letter
	$_SESSION['reg_fname'] = $fname; //Voornaam toevoegen aan session

	//Achternaam
	$lname = strip_tags($_POST['reg_lname']); //Restricties bij het invoeren
	$lname = str_replace(' ',' ', $lname); //Spaties verwijderen
	$lname = ucfirst(strtolower($lname)); //Hoofdletter eerste letter
	$_SESSION['reg_lname'] = $lname; //Achternaam toevoegen aan session

	//Email
	$email = strip_tags($_POST['reg_email']); //Restricties bij het invoeren
	$email = str_replace(' ',' ', $email); //Spaties verwijderen
	$email = ucfirst(strtolower($email)); //Hoofdletter eerste letter
	$_SESSION['reg_email'] = $email; //Mail toevoegen aan session

	//Email bevestigen
	$emailconfirm = strip_tags($_POST['reg_emailconfirm']); //Restricties bij het invoeren
	$emailconfirm = str_replace(' ',' ', $emailconfirm); //Spaties verwijderen
	$emailconfirm = ucfirst(strtolower($emailconfirm)); //Hoofdletter eerste letter
	$_SESSION['reg_emailconfirm'] = $emailconfirm; //Mail toevoegen aan session

	//Wachtwoord
	$password = strip_tags($_POST['reg_password']); //Restricties bij het invoeren
	$passwordconfirm = strip_tags($_POST['reg_passwordconfirm']); //Restricties bij het invoeren

	$date = date("Y-m-d"); //Datum

	if($email == $emailconfirm) {
		//Controleren of email in juiste format is ingevoerd
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			//Controleren of email al bestaat in de database
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

			//Tellen van het aantal rijen
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}

		} else {
			array_push($error_array, "Email format invalid<br>");
		}

	} else {
		array_push($error_array, "Email not matching<br>");
	}

	//Controleren van voor- en achternaam
	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "First Name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array, "Last Name must be between 2 and 25 characters<br>");
	}

	if($password != $passwordconfirm) {
		array_push($error_array, "Passwords do not match<br>");
	}
	else {
		//Controleren of alleen nummers en letters zijn gebruikt
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Password can only contain english characters<br>");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Password must be between 5 and 30 characters<br>");
	}

	if(empty($error_array)) {
		$password = md5($password); //Password encrypten voordat het in de database wordt toegevoegd

		//Aanmaken van gebruiker met voor- en achternaam
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

		$i = 0;
		//Wanneer gebruiker al bestaat voeg nummer toe aan gebruiker
		//TomasRust wordt dan TomasRust2
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//Profielfoto's: kans op één van de twee als standaard

		$rand = rand(1,2); //Random nummer tussen 1 en 2

		if($rand == 1)
			$profile_picture = "assets/images/profile_pictures/default_pictures/facebook.jpg";

		else if($rand == 2)
			$profile_picture = "assets/images/profile_pictures/default_pictures/superman.jpg";

		$query = mysqli_query($con, "INSERT INTO users VALUES('', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_picture', '0', '0', 'no', ',')");

		array_push($error_array, "<span style='color: #14C800;'>Registration complete. Welcome!</span><br>");

		//Na het registreren alles weghalen
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_emailconfirm'] = "";

	}
}

?>