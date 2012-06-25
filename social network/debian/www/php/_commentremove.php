<?php
require_once 'classes/comments.php';
session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}
$cid = $_GET['id'];
$uid = $_SESSION['id'];

$comments = new comment();

if(($comments->isOwner($cid,$uid))==0){
	header("Location: logout.php");
	die();
}

$comments->deleteComment($cid);

header("Location: comment.php");

?>
