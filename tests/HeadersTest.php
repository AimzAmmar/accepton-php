<?php

namespace AcceptOn;

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
        $this->assertEquals("application/json", self::$requestHeaders["Accept"]);
    }

    public function testBearerToken()
    {
        $this->assertEquals("Bearer skey_123", self::$requestHeaders["Authorization"]);
    }

    public function testUserAgent()
    {
        $this->assertEquals(self::$client->userAgent(), self::$requestHeaders["User-Agent"]);
    }
}
