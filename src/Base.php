<?php

namespace AcceptOn;

use AcceptOn\Utils;

class Base
{
    /**
     * Create an object representation of a model.
     *
     * @api public
     *
     * @param mixed[] $args The values to assign to the model.
     * @return AcceptOn\Base The model with assigned values.
     */
    public function __construct($args = null)
    {
        if ($args != null) {
            foreach ($args as $argName => $argValue) {
                $camelizedName = Utils::camelize($argName);
                $this->{$camelizedName} = $argValue;
            }
        }
    }
}
