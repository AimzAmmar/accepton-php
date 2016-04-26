<?php

namespace AcceptOn;

use AcceptOn\Test\DemoBase;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    protected static $model;

    public function setUp()
    {
        self::$model = new DemoBase(array(
            "foo" => "bar",
            "snake_case" => "1",
            "boolean" => "1",
            "bar" => "ignored"
        ));
    }

    public function testKnownProperty()
    {
        $this->assertEquals("bar", self::$model->foo);
        $this->assertEquals(1, self::$model->snakeCase);
        $this->assertEquals(true, self::$model->boolean);
    }

    public function testUnknownProperty()
    {
        $this->assertFalse(property_exists(get_class(self::$model), "bar"));
    }
}
