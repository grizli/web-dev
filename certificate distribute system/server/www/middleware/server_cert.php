<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';
include_once 'db.php';

function sendCert ($params) {

    // Parse our parameters.
	//none

    // Build our response.

	$query="SELECT value FROM MySecurity where name='public';";
	$results=mysql_query($query);
	$row = mysql_fetch_array($results);

	$certificate=$row[0];
	$struct = array('certificate' => new xmlrpcval($certificate, 'string'));
	return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$sendCert_sig = array('string');
$sumAndDifference_doc = 'Send certificate';

$getCert_sig = array(array('int','string'));
$getCert_sig = 'Get SP certificate';


new xmlrpc_server(array('security.certificate' =>
                        array('function' => 'sendCert',
                              'signature' => $sendCert_sig,
                              'docstring' => $sendCert_doc)));
?>
