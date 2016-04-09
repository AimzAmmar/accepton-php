<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use AcceptOn\Client;

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new Client(API_KEY, "staging");

$refund = $client->refund(600, "chg_0692c402b0357ae3");

print_r($refund);
