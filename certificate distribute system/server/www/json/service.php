<?php
include_once 'db.php';



class service {
	
	public function requestCert(){
		$query = "SELECT value FROM MySecurity WHERE name='public';";
		$results = mysql_query($query);
	        $row = mysql_fetch_array($results);
		$res = base64_encode($row[0]);
		return $res;
	}
	public function req($name,$oper,$value){
		$name=base64_decode($name);
		$oper=base64_decode($oper);
		$value=base64_decode($value);
		
		$query = "SELECT value FROM MySecurity WHERE name='private';";
		$results = mysql_query($query);
		$row = mysql_fetch_array($results);
		$private = $row[0];
		$key=openssl_get_privatekey($private);
		$namedec="";
		$operdec="";
		$valuedec="";
		openssl_private_decrypt($name,$namedec,$key);
		openssl_private_decrypt($oper,$operdec,$key);
		openssl_private_decrypt($value,$valuedec,$key);
		$valuec=base64_decode($valuedec);

		if ($operdec=="mycert"){
			$valuedec=$value;
			//openssl_sign($valuedec,$signed,$key);
			//$result=base64_encode($signed);
			$query = "INSERT INTO Service VALUES ('{$namedec}','','{$valuedec}');";
			mysql_query($query);
$result=$query;
		} else $result=$valuedec;
		$query = "SELECT Certificate FROM Service WHERE Name='{$name}';";
		$results = mysql_query($query);
		$row = mysql_fetch_array($results);
		$pkey = openssl_get_publickey($row[0]);
		//openssl_public_encrypt($result,$result,$pkey);
		$result = base64_encode($result);
		return $result;
	}
}

?>
