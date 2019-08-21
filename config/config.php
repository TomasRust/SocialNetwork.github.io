
<?php
ob_start(); //Buffer aanzetten


if(!isset($_SESSION)) {
	session_start(); //Met session zorgen dat tekst in de velden niet meer verdwijnen
					//if statement om melding notice te voorkomen
}

$timezone = date_default_timezone_set("Europe/Amsterdam");

$con = mysqli_connect("localhost", "root", "", "Social Network");

if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>