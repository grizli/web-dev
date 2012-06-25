<?php
require_once 'classes/user.php';
	
	$username = $_POST['username'];
	$psswd = $_POST['psswd'];

	$user = new user();

	$result = $user->getUserLogin($username,$psswd);
	
	if (!$result > 0) {
		header("Location: index.php?reason=login");
		die();
	} 

	session_start();
	$_SESSION['id']=$result;
	header("Location: home.php");
?>
