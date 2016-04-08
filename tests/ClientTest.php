<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigurableEnvironment()
    {
        $client = new Client("test", "development");
        $this->assertEquals("development", $client->environment);
    }

    public function testDefaultsToProductionEnvironment()
    {
        $client = new Client("test");
        $this->assertEquals("production", $client->environment);
    }

    public function testHasApiKeyIsTrueWhenConfigured()
    {
        $client = new Client("test");
        $this->assertEquals(true, $client->hasApiKey());
    }

    public function testHasApiKeyIsFalseWhenNotConfigured()
    {
        $client = new Client(null);
        $this->assertEquals(false, $client->hasApiKey());
    }

    public function testUserAgent()
    {
        $expected = "accepton-php/" . ACCEPTON_VERSION;
        $client = new Client("test");
        $this->assertEquals($expected, $client->userAgent());
    }
}
