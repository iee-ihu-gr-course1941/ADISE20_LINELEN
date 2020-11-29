
<?php
require "dbconnect.php";
		$Username = $_GET['Username'];
		$Username = stripcslashes($Username);
		$stmt1 = $mysqli->prepare('SELECT * from `Id`');
		$stmt1->execute();
		$result = $stmt1->get_result();

		if(mysqli_num_rows($result)==0){
		$_SESSION['user'] = "Id1";
		$_SESSION['Username'] = $Username;

		$stmt0 = $mysqli->prepare("DELETE FROM `Id`");
		$stmt0->execute();

		$stmt1 = $mysqli->prepare("UPDATE `cards` SET `owner`=null");
		$stmt1->execute();

		$stmt1 = $mysqli->prepare("UPDATE `game` SET `game_status`=null,`has_turn`=null");
		$stmt1->execute();

		$stmt = $mysqli->prepare("INSERT INTO `Id` (`Id`,`Username`) VALUES ('{$_SESSION['user']}','{$_SESSION['Username']}')");
		$stmt->execute();
		 header("Location: game.php");
		} else{
		$_SESSION['user'] = "Id2";
		$_SESSION['Username'] = $Username;
		$stmt3 = $mysqli->prepare("SELECT * FROM `Id` WHERE `Id`='Id1'");
		$stmt3->execute();
		$result = $stmt3->get_result();
		if(mysqli_num_rows($result)==0){
            $_SESSION['user']="Id1";
		}

		$stmt0 = $mysqli->prepare("SELECT * FROM `Id`");
		$stmt0->execute();
		$result = $stmt0->get_result();
		if(mysqli_num_rows($result)>=2){
		$stmt1 = $mysqli->prepare("DELETE FROM `Id`");
		$stmt1->execute();

		$stmt2 = $mysqli->prepare("UPDATE `cards` SET `owner`=null");
		$stmt2->execute();

		$stmt3 = $mysqli->prepare("UPDATE `game` SET `game_status`=null,`has_turn`=null");
		$stmt3->execute();

		$_SESSION['user'] = "Id1";
		}

        if ($_SESSION['user']=="Id2"){
		$stmt4 = $mysqli->prepare("UPDATE `game` SET `game_status`='initialized',`has_turn`=null");
		$stmt4->execute();
		}
		$stmt = $mysqli->prepare("INSERT INTO `Id` (`Id`,`Username`) VALUES ('{$_SESSION['user']}','{$_SESSION['Username']}')");
		$stmt->execute();
		 header("Location: game.php");
		}
?>

