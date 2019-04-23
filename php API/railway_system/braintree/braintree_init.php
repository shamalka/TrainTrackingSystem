<?php

session_start();
require_once("lib/autoload.php");
if(file_exists(__DIR__ . "/../.env")){
    $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
    $dotenv->load();
}

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantID('m6472vzmw88vdv6f');
Braintree_Configuration::publicKey('4ht43nxngq8v6cch');
Braintree_Configuration::privateKey('4e5b7b3b087cd8c1cb7aedbba676c5b5');

?>