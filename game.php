<?php
session_start();
if (!isset($_REQUEST['p'])) {
    $_REQUEST['p'] = '';
}
if ($_REQUEST['p'] == 'do_connect') {
    $_REQUEST['p'] = '';
    require "do_connect.php";
}
if (!isset($_SESSION['user'])) {
    header("Location: login2.php");
}
echo $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Game</title>
	 <link rel="stylesheet" type="text/css" href="css/game.css">
     <script src="game.js"></script>
</head>
<body>
<div id="board">
        <div id="Red">
            <img src="./image/red.png" alt="Red">
        </div>
        <div id="top_card">
            <img src="./image/display.png" alt="top_card">
        </div>

        <div class="player_box top">
            <p class="name">Player 1</p>
            <p class="number_of_cards">0</p>
        </div>
       
        <div class="player_box bottom">
            <p class="name"><?php echo ($_SESSION['Username']) ?></p>
            <p class="number_of_cards">0</p>
        </div>

        <button id="pass">Pass</button>
        <button id="assign_color">Assign Color</button>
</div>
        <div id="hand">
        </div>

</body>
</html>