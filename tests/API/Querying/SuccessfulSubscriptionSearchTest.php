<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulSubscriptionSearchTest extends \PHPUnit_Framework_TestCase
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
        self::$params = array("plan_token" => "pln_965d6898b660d85b");

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/recurring/subscriptions?plan.token=pln_965d6898b660d85b")
            ->then()->body(fixture_response("subscriptions_list.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsAListOfSubscriptions()
    {
        $subscriptions = self::$client->subscriptions(self::$params);

        $this->assertEquals(3, sizeof($subscriptions));
        foreach ($subscriptions as $subscription) {
            $this->assertEquals("AcceptOn\Subscription", get_class($subscription));
        }
    }
}
