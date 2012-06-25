<?php
	require_once 'classes/user.php';
	
	function chkr($result){
		if ($result == false){
			header("Location: register.php?reason=sth");
			die();
		}
	return;
	}
	
	$username = $_POST['username'];
	$psswd = $_POST['psswd'];
	$psswd2 = $_POST['psswd2'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	

	if(!$psswd==$psswd2){
		header("Location: register.php?reason=psswd");
		die();
	}
	
	$user=new user();
	$chk = $user->getUserID($username);
	if (!$chk == false){
		header("Location: register.php?reason=username");
		die();
	}
	
	$result = $user->insertNewUser($username,$psswd);
	chkr($result);

	$result = $user->getUserID($username);
	chkr($result);
	$id = $result;

	$result = $user->insertUserProfile($name,$surname,$id);
	
	session_start();
	$_SESSION['id']=$id;
	
	header("Location: home.php");
?>
