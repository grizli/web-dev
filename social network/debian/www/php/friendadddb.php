<?php
require_once 'classes/user.php';
session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}
$first = $_GET['f'];
$second = $_GET['s'];

$user = new user();

$user->addFriends($first,$second);

header("Location: friendsadd.php");

?>
