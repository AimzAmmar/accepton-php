<?php

namespace AcceptOn;

use AcceptOn\Utils;

abstract class Base
{
    protected static $allowedProperties = array();

    /**
     * Create an object representation of a model.
     *
     * @api public
     *
     * @param mixed[] $attrs The values to assign to the model.
     * @return AcceptOn\Base The model with assigned values.
     */
    public function __construct($attrs = array())
    {
        foreach ($attrs as $attrName => $attrValue) {
            $camelizedName = Utils::camelize($attrName);

            if (array_key_exists($camelizedName, $this::$allowedProperties)) {
                $this->{$camelizedName} = $this->coerceValue(
                    $attrValue,
                    $this::$allowedProperties[$camelizedName]
                );
            }
        }
    }

    /**
     * Coerces a value based on a given type hint.
     *
     * @param mixed $value The value to coerce.
     * @param string $typeHint The hint given for the value type.
     *
     * @return mixed The coerced value.
     */
    private function coerceValue($value, $typeHint)
    {
        if ($value == null || $typeHint == null) {
            return $value;
        }

        if ($typeHint == "int") {
            return (int) $value;
        } elseif ($typeHint == "string") {
            return (string) $value;
        } elseif ($typeHint == "bool") {
            return (bool) $value;
        } elseif ($typeHint == "date") {
            return date_parse($value);
        } elseif (class_exists($typeHint)) {
            return new $typeHint($value);
        } else {
            return $value;
        }
    }
}
