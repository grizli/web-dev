<?php

session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}

require_once 'classes/photo.php';

$user = $_GET['user'];
$photo = $_GET['photo'];
$r = $_GET['r'];

$like= new photo();

$like->toggleLike($user,$photo);

if ($r == 'f') header("Location: photofriends.php ");
else if ($r == 'p') header("Location: photopublic.php ");
else if ($r == 'm') header("Location: photomy.php ");
else header("Location: home.php");

?>
