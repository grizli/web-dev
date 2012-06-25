<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';
include_once 'db.php';

function sendCert ($params) {

    // Parse our parameters.
    $certval = $params->getParam(0);
    $cert = $certval->scalarval();
    $nameval = $params->getParam(1);
    $name = $nameval->scalarval();

	//fetch private key
	$query = "SELECT value FROM MySecurity WHERE name='private';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$priv_key=$row[0];
	$pkeyid = openssl_get_privatekey($priv_key);
	$signature;

	//sign public key of SP
	openssl_sign($cert, &$signature, $pkeyid);
	openssl_free_key($pkeyid);

	//save signature and name to the databas
	$signature = bin2hex($signature);

	$query = "INSERT INTO Service (Name) VALUES ('{$name}');";
	mysql_query($query);
	$query = "SELECT ID FROM Service WHERE Name='{$name}';";
	$results = mysql_query($query);
	$row = mysql_fetch_array($results);
	$id = $row[0];
	$query = "INSERT INTO Certificates VALUES ('{$id}','{$signature}','{$cert}')";
	mysql_query($query);

    // Build our response.
    $struct = array('ack' => new xmlrpcval($cert, 'string'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$sendCert_sig = array(array('struct', 'string','string'));
$sendCert_doc = 'Add and subtract two numbers';


new xmlrpc_server(array('security.certificate' =>
                        array('function' => 'sendCert',
                              'signature' => $sendCert_sig,
                              'docstring' => $sendCert_doc)));
?>
