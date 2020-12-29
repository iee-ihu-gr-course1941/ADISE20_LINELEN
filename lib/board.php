<?php

//πίνακας καρτών
$cards = array(1,2,3,4,5,6,7,8,9,10,11,12,13,
					14,15,16,17,18,19,20,21,22,23,24,25,26,
					27,28,29,30,31,32,33,34,35,36,37,38,39,
					40,41,42,43,44,45,46,47,48,49,50,51,52);

function show_board($input) {
	global $mysqli;
	
	$player_id=current_player($input['token']);
	show_board_by_player($player_id);
}

//Επανεκκίνηση του παιχνιδιού (reset τους πίνακες με βάση την clean_board)
function reset_board() {
	global $mysqli;
	
	$sql = 'call clean_board()';
	$mysqli->query($sql);
}

//εμφανίζει τις κάρτες των παικτών και της κεντρικής στοίβας
function read_hand($player_id) {
	global $mysqli;

	$position = 'hand' . $player_id;
	$sql = "select * from board where c_position=? or c_position='stack' or c_position='top'";
	$st = $mysqli->prepare($sql);
	$st->bind_param('s',$position);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_all(MYSQLI_ASSOC));
}

//επιστρεφει την επάνω κάρτα της στοίβας
function read_top_card() {
	global $mysqli;

	$sql = "select c_value from board where c_position='top'";
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_assoc()['c_value']);
}

//επιστρέφει το μέγεθος της στοίβας
function count_stack_cards() {
	global $mysqli;

	$sql = "select count(*) as c from board where c_position='stack'";
	$st = $mysqli->prepare($sql);
	$st->execute();
	$res = $st->get_result();
	return($res->fetch_assoc()['c']);
}
//εμφανίζει τα φύλλα που έχει στο χέρι του ο κάθε παίκτης
function show_board_by_player($player_id) {
	global $mysqli;

	$hand = read_hand($player_id);
	header('Content-type: application/json');
	print json_encode($hand, JSON_PRETTY_PRINT);
}

//ανακατεύει τις κάρτες του deck με βάση το $cards
function shuffle_deck() {
	global $mysqli;
	global $cards;
	shuffle($cards);
	for($i=1; $i<=sizeof($cards); $i++) {
		$sql = 'update board set c_order=? where card_id=?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('ii',$cards[$i-1],$i);
		$st->execute();
	}
}

//μοιράζει φύλλα στους παίκτες την πρώτη φορά
function deal_cards() {
	global $mysqli;

	shuffle_deck();
	$sql = "call deal_cards(4,'stack')";
	$mysqli->query($sql);
	$sql = "call deal_cards(6,'hand1')";
	$mysqli->query($sql);
	$sql = "call deal_cards(6,'hand2')";
	$mysqli->query($sql);

	$sql = "update board set c_position='top' where card_id in
			(select max(card_id) from (select card_id from board where c_position='stack') as x)";
	$st = $mysqli->prepare($sql);
	$st->execute();
}

//ξαναμοιράζει τα φύλλα για τους επόμενους γύρους
function deal_again() {
	global $mysqli;

	$sql = "call deal_cards(6,'hand1')";
	$mysqli->query($sql);
	$sql = "call deal_cards(6,'hand2')";
	$mysqli->query($sql);
}

//μετράει το σκορ αν τελειώσουν τα φύλλα της τράπουλας
function count_score() {
	global $mysqli;
	$winner=0;


	$sql = "select sum(c_score) as score1 from board where c_position='stack1'";
	$st5 = $mysqli->prepare($sql);
	$st5->execute();
	$res = $st5->get_result();
	$player1_total_score = $res->fetch_assoc()['score1'];

	$sql = "select sum(c_score) as score2 from board where c_position='stack2'";
	$st6 = $mysqli->prepare($sql);
	$st6->execute();
	$res = $st6->get_result();
	$player2_total_score = $res->fetch_assoc()['score2'];


	if($player1_total_score>$player2_total_score) $winner=1;
		else $winner=2;

	$sql = 'update game_status set status="ended", result=?';
	$st3 = $mysqli->prepare($sql);
	$st3->bind_param('i',$winner);
	$st3->execute();
}

//εμφανίζει error μέσω του json
//τρόπος παιξίματος παιχνιδιού (count_score,deal_again,show_board_by_player)
function play_card($id,$token) {
	global $mysqli;

	if($token==null || $token=='') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Token is not set."]);
		exit;
	}

	$player_id = current_player($token);
	if($player_id==null) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"You are not a player of this game."]);
		exit;
	}

	$status = read_status();
	if($status['status']!='started') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"Game is not in action."]);
		exit;
	}
	if($status['p_turn']!=$player_id) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"It is not your turn."]);
		exit;
	}

	$player_hand = read_hand($player_id);
	$cards = [];
	$i=0;
	foreach($player_hand as $row) {
		$cards[$i++] = $row['card_id'];
	}
	if(!in_array($id, $cards)) {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg'=>"This card is not in your hand."]);
		exit;
	}

	$top_card_value = read_top_card();

	$sql = 'select c_value from board where card_id=?';
	$st2 = $mysqli->prepare($sql);
	$st2->bind_param('i',$id);
	$st2->execute();
	$res = $st2->get_result();
	$play_card_value = $res->fetch_assoc()['c_value'];

	$stack_cards = count_stack_cards();

	if($top_card_value==$play_card_value) {
		$sql = 'call win_stack(?,?);';
			$st = $mysqli->prepare($sql);
			$st->bind_param('ii',$player_id,$id);
			$st->execute();


	}else {
		$sql = 'call play_card(?);';
		$st = $mysqli->prepare($sql);
		$st->bind_param('i',$id);
		$st->execute();
	}


	$sql = "select count(*) as c from board where c_position='deck'";
	$st4 = $mysqli->prepare($sql);
	$st4->execute();
	$res = $st4->get_result();
	$cards_on_deck = $res->fetch_assoc()['c'];

	$sql = "select count(*) as c from board where c_position='hand1' or c_position='hand2'";
	$st3 = $mysqli->prepare($sql);
	$st3->execute();
	$res = $st3->get_result();
	$cards_on_hands = $res->fetch_assoc()['c'];

	if($cards_on_deck==0 && $cards_on_hands==0) {
		count_score();
		exit;
	}

	if($cards_on_hands==0) {
		deal_again();
	}

	$sql = "select sum(c_score) as score1 from board where c_position='stack1'";
	$st5 = $mysqli->prepare($sql);
	$st5->execute();
	$res = $st5->get_result();
	$player1_total_score = $res->fetch_assoc()['score1'];

	$sql = "select sum(c_score) as score2 from board where c_position='stack2'";
	$st6 = $mysqli->prepare($sql);
	$st6->execute();
	$res = $st6->get_result();
	$player2_total_score = $res->fetch_assoc()['score2'];

	if($player1_total_score>=61 || $player2_total_score>=61){
		if($player1_total_score>=61){
		$winner=1;
		$sql = 'update game_status set status="ended", result=?';
		$st3 = $mysqli->prepare($sql);
		$st3->bind_param('i',$winner);
		$st3->execute();
	}
	else{ $winner=2;
		$sql = 'update game_status set status="ended", result=?';
		$st3 = $mysqli->prepare($sql);
		$st3->bind_param('i',$winner);
		$st3->execute();
	}	
}



	show_board_by_player($player_id);
}

?>