

$(document).ready(function() {

	//Bij een klik, log in verbergen en registratie laten zien
	$("#signup").click(function() {
		$("#first").slideUp("slow", function() {
			$("#second").slideDown("slow");

		})

	})

	//Bij een klik, registratie verbergen en log in laten zien
	$("#signin").click(function() {
		$("#second").slideUp("slow", function() {
			$("#first").slideDown("slow");

		})

	})

});