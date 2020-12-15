function show_opponent() {
	alert(
					"ololololo"
				);
	if (
		document.getElementById("opponent").innerHTML == "Waiting for opponent.."
	) {
		setInterval(function() {
			$("#opponent")
				.load("opponent.php")
				.fadeIn("slow");
		}, 3000);
	}
}




function fill_table() {
alert(
					"lalalalalalala"
				);
	}

