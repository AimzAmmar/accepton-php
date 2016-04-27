<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulPlanSearchTest extends \PHPUnit_Framework_TestCase
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
            ->when()->methodIs("GET")->pathIs("/v1/recurring/plans")
            ->then()->body(fixture_response("plans_list.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsAListOfPlans()
    {
        $plans = self::$client->plans();

        $this->assertEquals(3, sizeof($plans));
        foreach ($plans as $plan) {
            $this->assertEquals("AcceptOn\Plan", get_class($plan));
        }
    }
}
