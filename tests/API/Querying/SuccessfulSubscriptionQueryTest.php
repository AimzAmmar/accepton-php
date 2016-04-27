<?php

namespace AcceptOn;

use AcceptOn\Client;

class SuccessfulSubscriptionQueryTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $subscriptionId;

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
        self::$subscriptionId = "sub_123";

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/v1/recurring/subscriptions/" . self::$subscriptionId)
            ->then()->body(fixture_response("subscription.json"))->statusCode(200)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testReturnsASubscription()
    {
        $subscription = self::$client->subscription(self::$subscriptionId);

        $this->assertEquals("AcceptOn\Subscription", get_class($subscription));
        $this->assertEquals(false, $subscription->active);
        $this->assertEquals("test1@email.com", $subscription->email);
        $this->assertEquals("sub_123", $subscription->id);
        $this->assertEquals("AcceptOn\Plan", get_class($subscription->plan));
        $this->assertEquals("pln_965d6898b660d85b", $subscription->plan->id);
    }
}
