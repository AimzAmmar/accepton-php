<?php

namespace AcceptOn\Tests;

use AcceptOn\Client;

class UnsuccessfulRefundTest extends \PHPUnit_Framework_TestCase
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
        self::$params = array();

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/v1/refunds")
            ->then()->body(fixture_response("invalid_amount.json"))->statusCode(400)
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
        $refund = self::$client->refund(self::$params);
    }
}
