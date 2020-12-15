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
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <script src="js/game.js"></script>
     <script type="text/javascript">
        function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
             x.style.display = "block";
        } else {
             x.style.display = "none";
  }
}</script>
<script type="text/javascript">function show_opponent() {

    document.getElementById("opponent").innerHTML == "Waiting for opponent...";
        
}</script>

</head>
<body>

        <div id="Red">
            <img src="./image/red.png" alt="Red">
        </div>
        <div id="top_card">
            <img src="./image/display.png" alt="top_card">
        </div>

        <div class="player_box top">
            <p id="opponent">Waiting for ...</p>
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
        
       
            <button id="rules" onclick="myFunction()">Οδηγίες</button>
            <div id="myDIV">
            <h1>Πώς παίζεται;;</h1>
            <p>
Χρησιμοποιείται μία τράπουλα των 52 φύλλων και αρχικά μοιράζεται κάθε παίκτης από έξι φύλλα, ενώ αφήνονται στη μέση του τραπεζιού τέσσερα, το ένα επάνω στο άλλο, φτιάχνοντας μία στοίβα. Κάθε παίκτης παίζει με την σειρά, με φορά από δεξιά προς τα αριστερά, από ένα φύλλο που κρατάει στα χέρια του, το οποίο τοποθετεί επάνω στη στοίβα. Όταν ξεκινά η παρτίδα ο παίκτης που παίζει πρώτος (π.χ. ο Α) έχει δύο επιλογές: α) να ρίξει κάποιο από τα φύλλα που έχει στο χέρι του στην κεντρική στοίβα β) να μαζέψει το φύλλο που βρίσκεται στην κορυφή της κεντρικής στοίβας με κάποιο φύλλο που κρατάει στο χέρι όμοιας αξίας (π.χ. το φύλλο στην κορυφή της στοίβας είναι το 8 και ο Α να έχει επίσης φύλλο 8). Αυτό γίνεται ρίχνοντας το φύλλο του, οπότε μαζεύει και το επάνω φύλλο της στοίβας και τοποθετεί και τα δύο φύλλα σε δική του ξεχωριστή στοίβα, αφήνοντας όμως τα φύλλα φανερά (στο παράδειγμα μας ο Α ρίχνει το 8 του, μαζεύει και το 8 της κεντρικής στοίβας και τα βάζει στην δική του στοίβα-στην περίπτωση μας, «στοίβα Α»). Από τη στιγμή που κάποιος παίκτης ξεκίνησε δική του στοίβα, προστίθενται στις επιλογές των παικτών εκτός από τις α) και β) που προαναφέραμε, και άλλες δύο: γ) αν κρατάει στο χέρι του φύλλο όμοιο με τα φύλλα που βρίσκονται στην κορυφή της στοίβας ενός άλλου παίκτη, τότε μπορεί να το ρίξει και να πάρει τα φύλλα από την στοίβα του συγκεκριμένου παίκτη και να τα τοποθετήσει στην δική του στοίβα (π.χ. σε συνέχεια του προηγούμενου παραδείγματος, ο παίκτης Β κρατάει επίσης 8. Μπορεί να το ρίξει και να μαζέψει τα δύο 8άρια της στοίβας Α και να βάλει τα τρία 8άρια στη δική του στοίβα Β. Ομοίως, αν ο Γ έχει το τέταρτο 8, μπορεί να το ρίξει, να πάρει τα τρία 8άρια της στοίβας Β και να τοποθετήσει και τα τέσσερα πλέον 8άρια στην δική του στοίβα Γ). δ) αν κρατάει στο χέρι του φύλλο που είναι ίδιο με αυτά που έχει επάνω στην δική του στοίβα, μπορεί να ρίξει το φύλλο και να το προσθέσει σε αυτήν (π.χ. ο Β έχει σειρά να παίξει και κρατάει στο χέρι 3, ενώ στην κορυφή της στοίβας του -στοίβα Β- έχει άλλα δύο 3άρια. Μπορεί να το ρίξει στην στοίβα Β επάνω από τα ήδη υπάρχοντα 3άρια, οπότε στην κορυφή της στοίβας Β θα υπάρχουν τώρα τρία 3άρια). Αν ο παίκτης μαζέψει ξανά νέα φύλλα είτε από την κεντρική στοίβα είτε από την στοίβα κάποιου άλλου παίκτη, τα τοποθετεί επάνω από τα ήδη υπάρχοντα της στοίβας του (π.χ. είναι η σειρά του Δ να παίξει και κρατάει στο χέρι 5, το φύλλο στην κορυφή της κεντρικής στοίβας είναι επίσης 5, ενώ στην στοίβα του -στοίβα Δ- έχει ήδη δύο 10άρια. Ρίχνει λοιπόν το 5 του, μαζεύει το 5 της κεντρικής στοίβας και τοποθετεί και τα δύο στην στοίβα Δ, επάνω από τα 10άρια που είχε μαζέψει προηγουμένως). Τώρα στη συγκεκριμένη στοίβα, δεν μπορεί κάποιος αντίπαλος να μαζέψει τα φύλλα που βρίσκονται από κάτω (στο παράδειγμα μας τα 10άρια) επειδή καλύπτονται από αυτά που προστέθηκαν στη στοίβα τελευταία (στο παράδειγμα μας τα 5άρια). Μόνο αν μαζευτούν από τη στοίβα του παίκτη τα φύλλα που βρίσκονται στην κορυφή της (στο παράδειγμα μας τα 5άρια) μπορούν εν συνεχεία να μαζευτούν τα από κάτω που πλέον περνάνε στην κορυφή της στοίβας (στο παράδειγμα μας τα 10άρια). Να επισημάνουμε ότι οι παίκτες δεν είναι υποχρεωμένοι να μαζεύουν με κάποιο φύλλο τους όμοια φύλλα είτε από την κεντρική στοίβα, είτε από τις στοίβες των άλλων παικτών. Το τί θα κάνει ο κάθε παίκτης είναι στην ευχέρεια του. Όταν τελειώσουν όλοι οι παίκτες τα φύλλα τους, ξαναμοιράζονται από άλλα έξι ο καθένας (δεύτερη μοιρασιά) και όταν τελειώσουν και αυτά τα φύλλα, τελειώνει η παρτίδα. Τέλος παιχνιδιού ο παίκτης που θα συμπληρώσει πρώτος 61 πόντους ανακυρήσσεται νικητής. Εάν δύο ή περισσότεροι παίκτες ισοβαθμίσουν, ξαναπαίζουν μέχρι κάποιος να συγκεντρώσει υψηλότερη βαθμολογία από τους υπολοίπους</p>
        </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>