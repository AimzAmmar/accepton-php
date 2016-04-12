<?php

require_once(__DIR__ . "/../../vendor/autoload.php");

use AcceptOn\Client;

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new Client(API_KEY, "staging");

$params = array(
    "start_date" => "2015-06-01",
    "end_date" => "2015-07-01",
    "order_by" => "created_at",
    "order" => "asc"
);
$charges = $client->charges($params);

print_r($charges);
