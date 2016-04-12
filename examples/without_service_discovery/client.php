<?php

require_once(__DIR__ . "/../../vendor/autoload.php");

use AcceptOn\Client;
use Http\Adapter\Guzzle6\Client as HttpClient;
use Http\Message\MessageFactory\GuzzleMessageFactory as MessageFactory;

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$httpClient = new HttpClient();
$messageFactory = new MessageFactory();

$client = new Client(API_KEY, "staging");
$client->setHttpClient($httpClient);
$client->setMessageFactory($messageFactory);

$params = array(
    "amount" => 1000,
    "currency" => "usd",
    "description" => "Hipster Flannel Tshirt"
);
$token = $client->createToken($params);

echo $token->id;
