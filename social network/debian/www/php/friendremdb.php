<?php
require_once 'classes/mysql.php';
session_start();
if(!isset($_SESSION['id'])){
        header("Location: index.php");
}
$first = $_GET['f'];
$second = $_GET['s'];

$db = new mysql();

$db->delete('friends', 'IDmy='.$first.' AND IDfriend='.$second);
$db->delete('friends', 'IDfriend='.$first.' AND IDmy='.$second);

header("Location: friendsview.php");

?>
