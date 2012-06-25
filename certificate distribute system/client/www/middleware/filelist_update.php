<?php

include "xmlrpc.inc";
include "xmlrpcs.inc";
include_once 'db.php';

error_reporting(E_ALL);

$query = "SELECT * FROM Service;";
$results = mysql_query($query);
$row = mysql_fetch_assoc($results);
$serviceprovider = $row['Name'];
$address = $row['Address'];
$serviceid = $row['ID'];

$query = "SELECT value FROM MySecurity WHERE name='CR_cert';";
$results = mysql_query($query);
$row = mysql_fetch_array($results);
$pub_key=$row[0];
$pub = openssl_pkey_get_public($pub_key);

//openssl_public_encrypt ( string $data , string &$crypted , mixed $key



$server = new xmlrpc_client('middleware/client_update.php', 'phprpcserver', 80);

$query = "SELECT * FROM ListaDatoteka;";
$results = mysql_query($query);
while($row = mysql_fetch_assoc($results)){

	$fileid = $row['FileID'];
	$filename = $row['Name'];
	$author = $row['Author'];
	$desc = $row['Description'];

	openssl_public_encrypt($fileid,$fileidenc,$pub); 
	openssl_public_encrypt($filename,$filenameenc,$pub);
	openssl_public_encrypt($author,$authorenc,$pub);
	openssl_public_encrypt($desc,$descenc,$pub);
	openssl_public_encrypt($address,$addressenc,$pub);
	openssl_public_encrypt($serviceprovider,$serviceproviderenc,$pub);

	// Send a message to the server.
	$message = new xmlrpcmsg('register.filelists',
                         array(new xmlrpcval(bin2hex($fileidenc), 'string'), //fileid
			       new xmlrpcval(bin2hex($filenameenc),'string'), //filename
			       new xmlrpcval(bin2hex($authorenc),'string'), //author
			       new xmlrpcval(bin2hex($descenc),'string'), //desc
			       new xmlrpcval(bin2hex($addressenc),'string'), //desc
                               new xmlrpcval(bin2hex($serviceproviderenc), 'string'))); //serviceprovider

	$result = $server->send($message);

	// Process the response.
	if (!$result) {
    		print "<p>Could not connect to HTTP server.</p>";
	} elseif ($result->faultCode()) {
	    print "<p>XML-RPC Fault #" . $result->faultCode() . ": " .
        	$result->faultString();
	} else {
	    $struct = $result->value();
	    $sumval = $struct->structmem('ack');
	    $sum = $sumval->scalarval();
	    print "<p>Sum: " . htmlentities($sum) . "</p>";
	}
}

?>

