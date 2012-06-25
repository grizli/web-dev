<?php
// Fill in data for the distinguished name to be used in the cert
// You must change the values of these keys to match your name and
// company, or more precisely, the name and company of the person/site
// that you are generating the certificate for.
// For SSL certificates, the commonName is usually the domain name of
// that will be using the certificate, but for S/MIME certificates,
// the commonName will be the name of the individual who will use the
// certificate.
$dn = array(
    "countryName" => "HR",
    "stateOrProvinceName" => "12",
    "localityName" => "12",
    "organizationName" => "12",
    "organizationalUnitName" => "12",
    "commonName" => "12",
    "emailAddress" => "example@example.com"
);

// Generate a new private (and public) key pair
$privkey = openssl_pkey_new();

// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey);

// You will usually want to create a self-signed certificate at this
// point until your CA fulfills your request.
// This creates a self-signed cert that is valid for 365 days
$sscert = openssl_csr_sign($csr, null, $privkey, 365);

// Now you will want to preserve your private key, CSR and self-signed
// cert so that they can be installed into your web server, mail server
// or mail client (depending on the intended use of the certificate).
// This example shows how to get those things into variables, but you
// can also store them directly into files.
// Typically, you will send the CSR on to your CA who will then issue
// you with the "real" certificate.
openssl_csr_export($csr, $csrout) and var_dump($csrout);
openssl_x509_export($sscert, $certout) and var_dump($certout);
openssl_pkey_export($privkey, $pkeyout) and var_dump($pkeyout);

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pwd = 'eureka';

$database = 'pus';
$table = 'MySecurity';

if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

// Show any errors that occurred here
while (($e = openssl_error_string()) !== false) {
    echo $e . "\n";
}
mysql_query('INSERT INTO MySecurity VALUES ("csr","'.$csrout.'");');
mysql_query("INSERT INTO MySecurity VALUES ('public','{$certout}');");
mysql_query("INSERT INTO MySecurity VALUES ('private','{$pkeyout}');");

echo 'INSERT INTO "MySecurity" VALUES ("csr","'.$csrout.'");';
?>

