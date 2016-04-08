<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;
use AcceptOn\Headers;

class HeadersTest extends \PHPUnit_Framework_TestCase
{
    protected static $client;
    protected static $headers;
    protected static $requestHeaders;

    public function setUp()
    {
        self::$client = new Client("skey_123");
        self::$headers = new Headers(self::$client);
        self::$requestHeaders = self::$headers->requestHeaders();
    }

    public function testAcceptsHeader()
    {
        $this->assertEquals("application/json", self::$requestHeaders["accept"]);
    }

    public function testBearerToken()
    {
        $this->assertEquals("Bearer skey_123", self::$requestHeaders["authorization"]);
    }

    public function testUserAgent()
    {
        $this->assertEquals(self::$client->userAgent(), self::$requestHeaders["user_agent"]);
    }
}
