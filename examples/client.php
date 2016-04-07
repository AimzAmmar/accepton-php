<?php

require ("../lib/accepton.php");

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new \AcceptOn\Client(API_KEY, "staging");

$params = array(
    "amount" => 1000,
    "currency" => "usd",
    "description" => "Hipster Flannel Tshirt"
);

$token = $client->createToken($params);

echo $token->id;
