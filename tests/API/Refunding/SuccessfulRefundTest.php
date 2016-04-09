<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;

class SuccessfulRefundTest extends \PHPUnit_Framework_TestCase
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
        self::$params = array("amount" => 100, "charge_id" => "chg_123");

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/v1/refunds")
            ->then()->body(fixture_response("refund.json"))->statusCode(201)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsARefund()
    {
        $refund = self::$client->refund(self::$params);

        $this->assertEquals("ref_123", $refund->id);
        $this->assertEquals(100, $refund->amount);
        $this->assertNotNull($refund->created);
        $this->assertEquals("usd", $refund->currency);
        $this->assertNull($refund->metadata);
        $this->assertEquals("requested_by_customer", $refund->reason);
    }
}
