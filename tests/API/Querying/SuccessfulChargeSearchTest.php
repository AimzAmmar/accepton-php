<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;

class SuccessfulChargeSearchTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

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

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/charges")
            ->then()->body(fixture_response("charges_list.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsAListOfCharges()
    {
        $charges = self::$client->charges();

        $this->assertEquals(3, sizeof($charges));
        foreach ($charges as $charge) {
            $this->assertEquals("AcceptOn\Charge", get_class($charge));
        }
    }
}
