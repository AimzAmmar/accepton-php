<?php

namespace AcceptOn\Test;

use AcceptOn\Base;

class DemoBase extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "boolean" => "bool",
        "foo" => "string",
        "snakeCase" => "int",
    );
}
