<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;

class UnsuccessfulChargeQueryTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $chargeId;
    protected static $client;

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
        self::$chargeId = "chg_123";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/charges/" . self::$chargeId)
            ->then()->body(fixture_response("invalid_charge_id.json"))->statusCode(400)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    /**
     * @expectedException \AcceptOn\Error\BadRequest
     */
    public function testThrowsABadRequest()
    {
        $charge = self::$client->charge(self::$chargeId);
    }
}
