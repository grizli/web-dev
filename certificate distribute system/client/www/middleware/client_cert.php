<html>
<head>
<title>XML-RPC PHP Demo</title>
</head>
<body>
<h1>XML-RPC PHP Demo</h1>

<?php

include "xmlrpc.inc";
include "xmlrpcs.inc";

error_reporting(E_ALL);

// Make an object to represent our server.
echo "pozivam server";
$server = new xmlrpc_client('middleware/server_cert.php', 'phprpcserver', 80);
echo "ok";
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
    print "<p>Certificate: " . htmlentities($cert) . "</p>";
}

$server = new xmlrpc_client('middleware/client_cert.php', 'phprpcserver', 80);
$myCert='AAA';
$message_myCert = new xmlrpcmsg('security.certificate',
				array(new xmlrpcval($myCert, 'string')));
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
    print "<p>Status: " . htmlentities($cert) . "</p>";
}

$server = new xmlrpc_client('middleware/file_lists.php', 'phprpcserver', 80);
$myCert='AA';
$message_myCert = new xmlrpcmsg('register.files',
                                array(new xmlrpcval($myCert, 'string'),
					new xmlrpcval('AA', 'string'),
					new xmlrpcval('AA', 'string'),
					new xmlrpcval('AA', 'string'),
					new xmlrpcval('AA', 'string')));
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
    print "<p>Status2: " . htmlentities($cert) . "</p>";
}

$server = new xmlrpc_client('middleware/service_lists.php', 'phprpcserver', 80);
$myCert='AA';
$message_myCert = new xmlrpcmsg('register.service',
                                array(new xmlrpcval($myCert, 'string'),
                                        new xmlrpcval('AA', 'string'),
                                        new xmlrpcval(2, 'int')));
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
    print "<p>Status2: " . htmlentities($cert) . "</p>";
}

$server = new xmlrpc_client('middleware/other_client_cert.php', 'phprpcserver', 80);
$myCert='AA';
$message_myCert = new xmlrpcmsg('security.certificate',
                                array(new xmlrpcval($myCert, 'string')));
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
    print "<p>Status: " . htmlentities($cert) . "</p>";
}



?>

</body></html>
