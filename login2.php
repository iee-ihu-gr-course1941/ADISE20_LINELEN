<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php
		$con = mysqli_connect("localhost","root","dbgame");
		if(isset($_POST['log'])){
			$username = mysqli_real_escape_string($con,$_POST['username']);
		}
</head>
<body>
		<form class="" action="login2.php" method="POST">
			<div class="container">
				<label for="">Username/Password</label>
				<input type="text" id="username" placeholder="Username" name="username" />
				<input type="password" id="pass" placeholder="Password"name="password" />
				<button type="submit" class="btn" name="log">Login</button>
		</div>
	</form>
</body>
</html>