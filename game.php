<?php
	ob_start();
	session_start();

	require_once('dbconnect.php');
	if (!isset($_REQUEST['page'])){
		$_REQUEST['page']='start';
	}

	if (!isset($_SESSION['username'])){
		$_SESSION['username']='?';
	}
	if (!isset($_SESSION['admin'])){
		$_SESSION['admin']=-1;
	}
	
?>