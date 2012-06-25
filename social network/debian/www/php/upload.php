<?php

session_start();

if(!isset($_SESSION['id'])){
	header("Location: index.php");
}

$id = $_SESSION['id'];

require_once 'classes/photo.php';

$public = $_POST['public'];
$tags = $_POST['tags'];
if ($public=='1'){
	$public='1';
}else $public='0';

$photo = new photo();

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
//$content = addslashes($content);
fclose($fp);

//if(!get_magic_quotes_gpc())
//{
//    $fileName = addslashes($fileName);
//}

$fileName = date("YmdHis").$fileName;

$photo->uploadPhoto($id,$fileName,$content,$public,$tags);

//echo "<br>File $fileName uploaded<br>";
header("Location: photoupload.php?info=ok");

//var_dump($tags);

}
echo 'done';
?>


