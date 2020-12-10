<?php
session_start();
if (!isset($_REQUEST['log'])) {
    $_REQUEST['log'] = '';
}
if ($_REQUEST['log'] == 'do_connect') {
    $_REQUEST['log'] = '';
    require "do_connect.php";
}
if (!isset($_SESSION['user'])) {

    // Redirect them to the login page
    header("Location: login2.php");
}
echo $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
     <link rel="stylesheet" type="text/css" href="css/game.css">
     <script src="js/game.js"></script>


             
      
     <style>
        .exp{visibility: hidden;}
    </style>
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
            <p id="opponent">Waiting for opponent...</p>
            <p class="number_of_cards">0</p>
        </div>
       
        <div class="player_box bottom">
            <p class="name"><?php echo ($_SESSION['Username']) ?></p>
            <p class="number_of_cards">0</p>
        </div>

        <button id="pass">Pass</button>
        

        <div class="controls">
            <?php
        //emfanizei tin enarksi mono sto player1
        if ($_SESSION['user'] == "player1") {
            //echo "<button onclick='fill_table()' id='start' class='btn btn-primary'>ΕΝΑΡΞΗ</button>";
            echo "<button onclick='show_opponent()' id='start' >ΕΝΑΡΞΗ</button>";
        }?>
        </div>

        
            <button id="Odigies" onclick="unhide()">Show Answer</button>
        <div class="exp">
            <p class="and">Take your finger out of your ear and listen to me</p>
        </div>
        
</div>
        <div id="hand">
        </div>



</body>
</html>