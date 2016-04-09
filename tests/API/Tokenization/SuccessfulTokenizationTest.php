<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulTokenizationTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $params;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();

        self::$client = new Client("skey_123", "test");
        self::$params = array("amount" => 100, "description" => "Test Description");

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/v1/tokens")
            ->then()->body(fixture_response("token.json"))->statusCode(201)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsATransactionToken()
    {
        $token = self::$client->createToken(self::$params);

        $this->assertEquals("txn_b43a7e1e51410639979ab2047c156caa", $token->id);
        $this->assertEquals(100, $token->amount);
        $this->assertNotNull($token->created);
        $this->assertEquals("Test Description", $token->description);
    }
}
