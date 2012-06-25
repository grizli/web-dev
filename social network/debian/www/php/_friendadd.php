<?php
require_once 'classes/mysql.php';
session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}
$first = $_GET['f'];
$second = $_GET['s'];

$db = new mysql();

$data = array(
	'IDmy' => $first,
	'IDfriend' => $second);
$db->insert('request',$data);

header("Location: friendsadd.php");

?>
