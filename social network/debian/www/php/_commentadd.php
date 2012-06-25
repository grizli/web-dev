<?php
require_once 'classes/comments.php';
session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}
$text = $_POST['comment'];
$pic = $_POST['pic'];
$r = $_POST['r'];

$comments = new comment();

$comments->addComment($_SESSION['id'],$pic,$text);

if ($r == 'f') header("Location: photofriends.php ");
else if ($r == 'p') header("Location: photopublic.php ");
else if ($r == 'm') header("Location: photomy.php ");
else header("Location: home.php");

?>
