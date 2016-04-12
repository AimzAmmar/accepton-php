<?php

require_once(__DIR__ . "/../../vendor/autoload.php");

use AcceptOn\Client;

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new Client(API_KEY, "staging");

$params = array(
    "amount" => 600,
    "charge_id" => "chg_0692c402b0357ae3",
);
$refund = $client->refund($params);

print_r($refund);
