<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;

class SuccessfulChargeQueryTest extends \PHPUnit_Framework_TestCase
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
        self::$chargeId = "chg_ff6024ab78980de7";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/charges/" . self::$chargeId)
            ->then()->body(fixture_response("charge.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsACharge()
    {
        $charge = self::$client->charge(self::$chargeId);

        $this->assertEquals("AcceptOn\Charge", get_class($charge));
        $this->assertEquals("chg_ff6024ab78980de7", $charge->id);
        $this->assertEquals(1000, $charge->amount);
        $this->assertNull($charge->application_fee);
        $this->assertEquals("usd", $charge->currency);
        $this->assertEquals("Test Transaction", $charge->description);
        $this->assertNotNull($charge->metadata);
        $this->assertEquals(false, $charge->refunded);
        $this->assertEquals("ch_16I54f2EZMTOjTLjGB8nd84P", $charge->remote_id);
        $this->assertEquals("paid", $charge->status);
    }
}
