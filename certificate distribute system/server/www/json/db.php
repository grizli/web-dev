<?php

//public function base(){
	$db_host = '127.0.0.1';
	$db_user = 'root';
	$db_pwd = 'eureka';

	$database = 'pus';

	if (!mysql_connect($db_host, $db_user, $db_pwd))
	    die("Can't connect to database");
	$connection=mysql_select_db($database);
	if (!$connection)
	    die("Can't select database");

	// Show any errors that occurred here
	while (($e = openssl_error_string()) !== false) {
	    echo $e . "\n";
	}
//	return $connection;
//}

?>
