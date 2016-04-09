<?php

require ("../src/accepton.php");

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new \AcceptOn\Client(API_KEY, "staging");

$charge = $client->charges(1000, "chg_123", "2015-06-01", "2015-07-01", "created_at", "asc");

print_r($charge);
