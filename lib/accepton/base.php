<?php

namespace AcceptOn;

class Base
{
    public function __construct($args = null)
    {
        if ($args != null) {
            foreach ($args as $argName => $argValue) {
                $this->{$argName} = $argValue;
            }
        }
    }
}
