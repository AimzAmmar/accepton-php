<?php

require ("../lib/accepton.php");

//Public key: pkey_79f7b3fdd512bbcb
//define("API_KEY", 'pkey_79f7b3fdd512bbcb');
define("API_KEY", 'skey_2beab875f373d5e605f13207be57c82c');
//define("API_KEY", '<API_KEY>');

//$client = new \AcceptOn\Client(API_KEY, "staging");
$client = new \AcceptOn\Client(API_KEY, "production");

$token = $client->create_token(1099, 99, 'cad', "test charge");

echo $token->id;
