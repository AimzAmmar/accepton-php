<?php

require ("../lib/accepton.php");

define("API_KEY", "skey_2beab875f373d5e605f13207be57c82c");

$client = new \AcceptOn\Client(API_KEY, "staging");

$charge = $client->refund(600, "chg_0692c402b0357ae3");

print_r($charge);
