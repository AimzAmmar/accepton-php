<?php

require ("../lib/accepton.php");

define("API_KEY", '<API_KEY>');

$client = new \AcceptOn\Client(API_KEY, "staging");

$token = $client->create_token(1099, 99, 'cad', "test charge");

echo $token->id;
