<?php

namespace AcceptOn;

use AcceptOn\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigurableEnvironment()
    {
        $client = new Client("test", "development");
        $this->assertEquals("development", $client->environment);
    }

    public function testConfigurableHttpSetup()
    {
        $http = "my http";
        $messageFactory = "my factory";
        $client = new Client("test", "development");

        $client->setHttpClient($http);
        $client->setMessageFactory($messageFactory);

        $this->assertEquals($http, $client->http());
        $this->assertEquals($messageFactory, $client->messageFactory());
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
        $expected = "accepton-php/" . AcceptOn::VERSION;
        $client = new Client("test");
        $this->assertEquals($expected, $client->userAgent());
    }
}
