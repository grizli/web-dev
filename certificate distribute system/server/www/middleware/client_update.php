<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';
include_once 'db.php';

function sendUpdate ($params) {

    	// Parse our parameters.
    	$nameval = $params->getParam(0); //SPname
    	$name = $nameval->scalarval();
    	$authorval = $params->getParam(1); //author , Desc, Filename, Saddress
    	$author = $authorval->scalarval();
	$descval = $params->getParam(2);
	$desc = $descval->scalarval();
	$filenameval = $params->getParam(3);
	$filename = $filenameval->scalarval();
	$fileidval = $params->getParam(4);
	$fileid = $fileidval->scalarval();
	$addressval = $params->getParam(5);
	$address = $addressval->scalarval();

//openssl_private_encrypt ( string $data , string &$crypted , mixed $key
	//fetch private key
	$query = "SELECT value FROM MySecurity WHERE name='private';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$priv_key=$row[0];
	$pkeyid = openssl_get_privatekey($priv_key);
	$signature;

	$name=base_convert($name,16,2);
	$author=base_convert($author,16,2);
	$desc=base_convert($desc,16,2);
	$filename=base_convert($filename,16,2);
	$address=base_convert($address,16,2);
	$fileid=base_convert($fileid,16,2);
/*
	openssl_private_decrypt($name,$namedec,$pkeyid);
	openssl_private_decrypt($author,$authordec,$pkeyid);
	openssl_private_decrypt($desc,$descdec,$pkeyid);
	openssl_private_decrypt($filename,$filenamedec,$pkeyid);
	openssl_private_decrypt($address,$addressdec,$pkeyid);
	openssl_private_decrypt($fileid,$fileiddec,$pkeyid);
	
	$query = "SELECT ID FROM Service WHERE Name='{$namedec}';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$serviceid = $row[0];

	$fileiddec = bin2hex($fileid);
	$filenamedec = bin2hex($filename);
	$authordec = bin2hex($author);
	$descdec = bin2hex($desc);
	$addressdec = bin2hex($address);

	$query = "INSERT INTO ListaDatoteka VALUES ('($fileiddec)','{$filenamedec}','{$authordec}','{$descdec}','{$serviceid}','{$addressdec}');";

	mysql_query($query);

	$query = "SELECT * FROM ListaDatoteka WHERE ServiceID<>'{$serviceid}';";
	openssl_free_key($pkeyid);

	//do sada je dodana nova lista datoteka ukoliko ne postoji TODO teba dodati prvojeru postojanosti
*/
// Build our response.
    $struct = array('ack' => new xmlrpcval($name, 'string'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$sendCert_sig = array(array('struct', 'string','string','string','string','string','string'));
$sendCert_doc = 'Add and subtract two numbers';


new xmlrpc_server(array('register.filelists' =>
                        array('function' => 'sendUpdate',
                              'signature' => $sendCert_sig,
                              'docstring' => $sendCert_doc)));
?>
