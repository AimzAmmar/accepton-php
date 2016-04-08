<?php

namespace AcceptOn\Tests;

use \AcceptOn\Error\Error;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    protected static $error;

    public function setUp()
    {
        self::$error = new Error("this is the message", 400);
    }

    public function testStatusCodeFromResponseMapping()
    {
        $response = '{"error": {"message": "error message"}}';

        foreach (Error::errors() as $status => $error) {
            $instance = Error::fromResponse($response, $status);
            $this->assertEquals($error, "\\" . get_class($instance));
        }
    }

    public function testBlankMessageForUnknownErrorStructure()
    {
        $instance = Error::fromResponse("{}", 400);
        $this->assertEquals("", $instance->message);
    }

    public function testNullForUnknownStatusCode()
    {
        $instance = Error::fromResponse("{}", 999);
        $this->assertNull($instance);
    }

    public function testMessage()
    {
        $this->assertEquals("this is the message", self::$error->message);
    }

    public function testStatusCode()
    {
        $this->assertEquals(400, self::$error->statusCode);
    }
}
