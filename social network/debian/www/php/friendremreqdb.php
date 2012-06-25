<?php
require_once 'classes/mysql.php';
session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}
$first = $_GET['f'];
$second = $_GET['s'];

$db = new mysql();

$db->delete('request', 'IDmy='.$second.' AND IDfriend='.$first);

header("Location: friendsrequests.php");

?>
