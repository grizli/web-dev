<?php
echo "yebem ti mater";
require_once 'jsonRPCClient.php';
include_once 'db.php';
//include_once 'sec.php';
echo "ok";
$server = new jsonRPCClient('http://192.168.56.101/json/server.php');
$myname="SP01";
$myaddr="anakin";

try{
	$get=$server->requestCert();
	$get=base64_decode($get);
	echo $get;
	$query = "INSERT INTO MySecurity VALUES ('CR_cert','{$get}');";
	mysql_query($query);
	echo $query;

	$query = "SELECT value FROM MySecurity WHERE name='CR_cert';";
        $results = mysql_query($query);
        $row = mysql_fetch_array($results);
        $public = $row[0];
        $pukey = openssl_get_publickey($public);

	$query = "SELECT value FROM MySecurity WHERE name='public';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$cert = $row[0];

	$name=$myname;
	$value=$cert;
	$nameen="";
	$operen="";
	$valueen="";
	openssl_public_encrypt($name,$name,$pukey); 
	$oper="mycert";
	openssl_public_encrypt($oper,$oper,$pukey);
	openssl_public_encrypt($value,$value,$pukey);
	$oper=base64_encode($oper);
	$value=base64_encode($value);
	$name=base64_encode($name);
//echo "<br/>value<br/>";
//var_dump($value);
	$get = $server->req($name,$oper,$value);
var_dump(base64_decode($get));


}catch(Exception $e){
	echo nl2br($e->getMessage()).'<br />'."\n";
}


echo "done".$query;
?>
