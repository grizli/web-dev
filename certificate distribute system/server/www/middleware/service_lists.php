<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';

function getList ($params) {

    // Parse our parameters.
	$serviceipval = $params->getParam(0);
	$serviceip = $serviceipval->scalarval();

	$nameval = $params->getParam(1);
	$name = $nameval->scalarval();

	$idval = $params->getParam(2);
	$id = $idval->scalarval();

if ($id==2) $ack="ok";
else $ack="false";

    // Build our response.
    $struct = array('ack' => new xmlrpcval($ack, 'string'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$getList_sig = array(array('struct', 'string','string','int'));
$getList_doc = 'Add and subtract two numbers';


new xmlrpc_server(array('register.service' =>
                        array('function' => 'getList',
                              'signature' => $getList_sig,
                              'docstring' => $getList_doc)));
?>
