<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';

function getList ($params) {

    // Parse our parameters.
	$fileidval = $params->getParam(0);
	$fileid = $fileidval->scalarval();

	$filenameval = $params->getParam(1);
	$filename = $filenameval->scalarval();
	
	$fileauthorval = $params->getParam(2);
	$fileauthor = $fileauthorval->scalarval();
	
	$filedescval = $params->getParam(3);
	$filedesc = $filedescval->scalarval();

	$serviceproviderval = $params->getParam(4);
	$serviceprovider = $serviceproviderval->scalarval();

if ($fileid=='AA') $ack="ok";
else $ack="false";

    // Build our response.
    $struct = array('ack' => new xmlrpcval($ack, 'string'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$getList_sig = array(array('struct', 'string','string','string','string','string'));
$getList_doc = 'Add and subtract two numbers';


new xmlrpc_server(array('register.files' =>
                        array('function' => 'getList',
                              'signature' => $getList_sig,
                              'docstring' => $getList_doc)));
?>
