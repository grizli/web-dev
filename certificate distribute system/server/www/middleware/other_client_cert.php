<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';

function getCert ($params) {

    // Parse our parameters.
    $nameval = $params->getParam(0);
    $name = $nameval->scalarval();

if ($name=='AA') $ack="ok";
else $ack="false";

    // Build our response.
    $struct = array('ack' => new xmlrpcval($ack, 'string'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$getCert_sig = array(array('struct', 'string'));
$getCert_doc = 'Add and subtract two numbers';


new xmlrpc_server(array('security.certificate' =>
                        array('function' => 'getCert',
                              'signature' => $sendCert_sig,
                              'docstring' => $sendCert_doc)));
?>
