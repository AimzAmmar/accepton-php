<?php

namespace AcceptOn;

use AcceptOn\Client;

class UnsuccessfulPlanQueryTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $planId;
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
        self::$planId = "pln_123";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/recurring/plans/" . self::$planId)
            ->then()->body(fixture_response("invalid_plan_id.json"))->statusCode(400)
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
        $plan = self::$client->plan(self::$planId);
    }
}
