<?php

require ("../lib/accepton.php");

//define("API_KEY", '<API_KEY>');
define("API_KEY", 'skey_2beab875f373d5e605f13207be57c82c');

$client = new \AcceptOn\Client(API_KEY, "staging");

//$token = $client->create_token(1099, 99, 'cad', "test charge");
//$token = $client->create_token(1000, null, 'usd', "Hipster Flannel Tshirt");
$token = $client->create_token(array("amount" => 1000, "currency" => "usd", "description" => "Hipster Flannel Tshirt"));

echo $token->id;
