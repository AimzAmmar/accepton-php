<?php

namespace AcceptOn;

use AcceptOn\Client;

class UnsuccessfulSubscriptionCancellationTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $client;
    protected static $subscriptionId;

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
        self::$subscriptionId = "sub_123";

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/v1/subscriptions/" . self::$subscriptionId . "/cancel")
            ->then()->body(fixture_response("cancel_failure.json"))->statusCode(401)
            ->end();

        $this->http->setUp();
    }

    /**
     * @expectedException AcceptOn\Error\Unauthorized
     */
    public function testRaisesAnUnauthorized()
    {
        $subscription = self::$client->cancelSubscription(self::$subscriptionId);
    }
}
