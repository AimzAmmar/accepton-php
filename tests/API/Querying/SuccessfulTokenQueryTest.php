<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulTokenQueryTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $tokenId;

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
        self::$tokenId = "txn_b43a7e1e51410639979ab2047c156caa";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/tokens/" . self::$tokenId)
            ->then()->body(fixture_response("token.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsAToken()
    {
        $token = self::$client->token(self::$tokenId);

        $this->assertEquals("AcceptOn\TransactionToken", get_class($token));
        $this->assertEquals(100, $token->amount);
        $this->assertEquals("Test Description", $token->description);
        $this->assertEquals("txn_b43a7e1e51410639979ab2047c156caa", $token->id);
    }
}
