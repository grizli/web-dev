<?php
include_once 'db.php';


        $query="SELECT value FROM MySecurity where name='public';";
        $results=mysql_query($query);
        $row = mysql_fetch_array($results);
	$public = $row[0];

	$query="SELECT value FROM MySecurity where name='private';";
        $results=mysql_query($query);
        $row = mysql_fetch_array($results);
	$private = $row[0];
	$crypted;

	
	openssl_public_encrypt("Jebem ti mater usranu", $pusimikurac, $public);

	echo '<p>chiper</br>'.htmlentities($pusimikurac).'</p>';
	echo ord($pusimikurac[0]).'</br>';
	echo chr(ord($pusimikurac[0]));
	
	$sexano=bin2hex($pusimikurac);
	echo '<p>chiper2hex</br>'.$sexano.'</p>';
	$kreten=base_convert($sexano,16,2);
	echo '<p>chiper2hex2bin</br>'.$kreten.'</p>';
	openssl_private_decrypt($pusimikurac,$mrsukurac,$private);
	echo $mrsukurac;
?>




