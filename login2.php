<!DOCTYPE html>
<html>
<head>
	<style>
body  {
  background-color: #cccccc;
}
</style>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php
		$con = mysqli_connect("localhost","root","","dbgame");
		if(isset($_POST['log'])){
			$username = mysqli_real_escape_string($con,$_POST['username']);
			$password = mysqli_real_escape_string($con,$_POST['password']);

			if ($username!= "" && $password!= "") {
				$sql = "SELECT Id FROM login WHERE Username='$username' and Password='$password' ";
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

				$count = mysqli_num_rows($result);
				if ($count == 1) {
					header("location: game.php");
				}
				}
			}

		?>
</head>
<body>
		<form class="" action="login2.php" method="POST">
			<div class="container">
				<label for="">Username/Password</label>
				<input type="text" id="username" placeholder="Username" name="username" />
				<input type="password" id="pass" placeholder="Password" name="password" />
				<button type="submit" class="btn" name="log">Login</button>
		</div>
	</form>
</body>
</html>