<?php

include "xmlrpc.inc";
include "xmlrpcs.inc";
include_once 'db.php';

error_reporting(E_ALL);

// Make an object to represent our server.
$server = new xmlrpc_client('middleware/server_cert.php', 'phprpcserver', 80);

// Send a message to the server.
$message = new xmlrpcmsg('security.certificate',null);
$result = $server->send($message);

// Process the response.
if (!$result) {
    print "<p>Could not connect to PHPRPCserver server.</p>";
} elseif ($result->faultCode()) {
    print "<p>XML-RPC Fault #" . $result->faultCode() . ": " .
        $result->faultString();
} else {
    $struct = $result->value();
    $certval = $struct->structmem('certificate');
    $cert = $certval->scalarval();
    //echo htmlentities($cert);
    mysql_query("INSERT INTO MySecurity VALUES ('CR_cert','{$cert}');");
    echo "<p>CR certificate saved!</p>";
}   



$name="SP01";
$server = new xmlrpc_client('middleware/client_cert.php', 'phprpcserver', 80);

$query = "SELECT value FROM MySecurity WHERE name='public';";
$results = mysql_query($query);
$row = mysql_fetch_array($results);

$myCert = $row[0];

$message_myCert = new xmlrpcmsg('security.certificate',
                                array(new xmlrpcval($myCert, 'string'),
				      new xmlrpcval($name, 'string')));
$result_myCert = $server->send($message_myCert);

if (!$result_myCert) {
    print "<p>Could not connect to PHPRPCserver server.</p>";
} elseif ($result_myCert->faultCode()) {
    print "<p>XML-RPC Fault #" . $result_myCert->faultCode() . ": " .
        $result_myCert->faultString();
} else {
    $struct = $result_myCert->value();
    $certval = $struct->structmem('ack');
    $cert = $certval->scalarval();
    echo "<p>Status: " . htmlentities($cert) . "</p>";
}


?>
