<?php

namespace AcceptOn;

use AcceptOn\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testCamelize()
    {
        $this->assertEquals("foo", Utils::camelize("foo"));
        $this->assertEquals("fooBar", Utils::camelize("foo_bar"));
        $this->assertEquals("", Utils::camelize(null));
        $this->assertEquals("", Utils::camelize(""));
    }
}
