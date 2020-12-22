$(document).ready(function() {
	show_opponent();
});



function show_opponent() {
if (
		document.getElementById("opponent").innerHTML == "Waiting for opponent..."
	) {
		setInterval(function() {
			$("#opponent")
				.load("show_opponent.php")
				.fadeIn("slow");
		}, 3000);
	}
}




function fill_table() {
alert(
					"lalalalalalala"
				);
	}

