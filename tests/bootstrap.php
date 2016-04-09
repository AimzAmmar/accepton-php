<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

function fixture_response($path)
{
    return file_get_contents(__DIR__ . "/fixtures/" . $path, true);
}
