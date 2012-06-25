<?php

require_once 'classes/user.php';

$user=new user();
echo 'ok';
$result = $user->getUserID('N1');
var_dump($result);
$result = $user->insertUserProfile('N1','N1',3);
var_dump($result);

?>
