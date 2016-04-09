<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use AcceptOn\Client;

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new Client(API_KEY, "staging");
$charges = $client->charges(1000, "chg_123", "2015-06-01", "2015-07-01", "created_at", "asc");

print_r($charges);
