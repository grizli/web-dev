<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';

function sumAndDifference ($params) {

    // Parse our parameters.
    $xval = $params->getParam(0);
    $x = $xval->scalarval();

    $yval = $params->getParam(1);
    $y = $yval->scalarval();

if ($x=='AA') $y=$y*$y;

    // Build our response.
    $struct = array('sum' => new xmlrpcval('responsic', 'string'),
                    'difference' => new xmlrpcval($y - $y, 'int'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

// Declare our signature and provide some documentation.
// (The PHP server supports remote introspection. Nifty!)
$sumAndDifference_sig = array(array('struct', 'string', 'int'));
$sumAndDifference_doc = 'Add and subtract two numbers';


new xmlrpc_server(array('sample.sumAndDifference' =>
                        array('function' => 'sumAndDifference',
                              'signature' => $sumAndDifference_sig,
                              'docstring' => $sumAndDifference_doc)));
?>
