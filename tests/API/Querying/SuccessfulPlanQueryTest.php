<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulPlanQueryTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $planId;

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
        self::$planId = "pln_123";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/recurring/plans/" . self::$planId)
            ->then()->body(fixture_response("plan.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsAPlan()
    {
        $plan = self::$client->plan(self::$planId);

        $this->assertEquals("AcceptOn\Plan", get_class($plan));
        $this->assertEquals(1000, $plan->amount);
        $this->assertEquals("usd", $plan->currency);
        $this->assertEquals("Test Plan", $plan->name);
        $this->assertEquals("month", $plan->periodUnit);
    }
}
