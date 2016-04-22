<?php

namespace AcceptOn;

use AcceptOn\Client;

class UnsuccessfulPlanCreationTest extends \PHPUnit_Framework_TestCase
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
            ->then()->body(fixture_response("invalid_name.json"))->statusCode(400)
            ->end();

        $this->http->setUp();
    }

    /**
     * @expectedException \AcceptOn\Error\BadRequest
     */
    public function testRaisesABadRequest()
    {
        $plan = self::$client->createPlan(self::$params);
    }
}
