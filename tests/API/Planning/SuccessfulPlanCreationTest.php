<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulPlanCreationTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $params;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass("8082", "localhost");
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();

        self::$client = new Client("skey_123", "test");
        self::$params = array(
            "amount" => 1000,
            "currency" => "usd",
            "name" => "Test Plan",
            "period_unit" => "month",
        );

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/v1/recurring/plans")
            ->then()->body(fixture_response("plan.json"))->statusCode(201)
            ->end();

        $this->http->setUp();
    }

    public function testReturnsAPlan()
    {
        $plan = self::$client->createPlan(self::$params);

        $this->assertEquals(1000, $plan->amount);
        $this->assertNotNull($plan->createdAt);
        $this->assertEquals("usd", $plan->currency);
        $this->assertEquals("Test Plan", $plan->name);
        $this->assertEquals("month", $plan->periodUnit);
    }
}
