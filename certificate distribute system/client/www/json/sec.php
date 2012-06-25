<?php
//include_once 'db.php';

public function data2send($data){
	$query = "SELECT value FROM MySecurity WHERE name='CR_cert';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$pkey = openssl_get_publickey($key);
	openssl_public_encrypt($data,$result,$pkey);
	return base64_encode($result);
}

public function data2sendClient($data,$name){
	$query = "SELECT Certificate FROM Service WHERE Name='{$name}';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$key = $row[0];
        $pkey = openssl_get_publickey($key);
        openssl_public_encrypt($data,$result,$pkey);
        return base64_encode($result);
}


public function data2receive($data){
        $query = "SELECT value FROM Service WHERE name='private';";
        $results = mysql_query($query);
        $row = mysql_fetch_array($results);
        $key = $row[0];
        $pkey = openssl_get_privatekey($key);
        openssl_private_encrypt($data,$result,$pkey);
        return $result;
}

?>
