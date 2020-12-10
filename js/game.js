function unhide() {
                    var hid = document.getElementsByClassName("exp");
                    // Emulates jQuery $(element).is(':hidden');
                    if(hid[0].offsetWidth > 0 && hid[0].offsetHeight > 0) {
                        hid[0].style.visibility = "visible";
                    }
                }



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

