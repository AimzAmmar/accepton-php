<?php

namespace AcceptOn;

use AcceptOn\Client;
use AcceptOn\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    use \InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    protected static $errorRequest;
    protected static $client;
    protected static $getRequest;
    protected static $postRequest;

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
        self::$getRequest = new Request(
            self::$client,
            "get",
            "/path",
            array(
                "environment" => "test",
                "test" => "value",
                "test2" => "value2"
            )
        );
        self::$postRequest = new Request(
            self::$client,
            "post",
            "/path",
            array(
                "environment" => "test",
                "test" => "value",
                "test2" => "value2"
            )
        );
        self::$errorRequest = new Request(
            self::$client,
            "post",
            "/error",
            array("environment" => "test")
        );

        $this->http->mock
            ->when()->methodIs("GET")->pathIs("/path")
            ->then()->body('{"foo":"bar"}')
            ->end();

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/path")
            ->then()->body('{"foo":"bar"}')
            ->end();

        $this->http->mock
            ->when()->methodIs("POST")->pathIs("/error")
            ->then()->body('{"error":{"message": "something happened"}}')->statusCode(401)
            ->end();

        $this->http->setUp();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    public function testBearerAuthorizationHeader()
    {
        self::$getRequest->perform();
        $this->assertEquals("Bearer skey_123", $this->latestRequest()->getHeaders()["Authorization"]);
    }

    public function testUserAgentSetFromClient()
    {
        self::$getRequest->perform();
        $this->assertEquals(self::$client->userAgent(), $this->latestRequest()->getHeaders()["User-Agent"]);
    }

    public function testThatParamsAreQueryStringForGet()
    {
        self::$getRequest->perform();
        $query = $this->latestRequest()->getQuery();
        $this->assertEquals("value", $query["test"]);
        $this->assertEquals("value2", $query["test2"]);
    }

    public function testThatParamsAreJsonBodyForPost()
    {
        self::$postRequest->perform();
        $body = json_decode((string)$this->latestRequest()->getBody());
        $this->assertEquals("value", $body->test);
        $this->assertEquals("value2", $body->test2);
    }

    /**
     * @expectedException \AcceptOn\Error\Unauthorized
     */
    public function testThatErrorsAreThrown()
    {
        self::$errorRequest->perform();
    }

    private function latestRequest()
    {
        return $this->http->requests->latest();
    }
}
