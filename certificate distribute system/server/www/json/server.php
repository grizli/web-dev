<?php
require_once 'jsonRPCServer.php';
require 'service.php';
require 'restrictedExample.php';

$myExample = new restrictedExample();
jsonRPCServer::handle($myExample)
    or print 'no request';
?>
