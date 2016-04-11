<?php

namespace AcceptOn;

class Utils
{
    /**
     * Camelizes a string.
     *
     * @api public
     *
     * @param string $value The string to camelize.
     * @return string The camelized string.
     */
    public static function camelize($value)
    {
        if ($value == null || gettype($value) !== 'string') {
            return "";
        }

        return preg_replace_callback(
            "/[-_]([a-z])/",
            function ($matches) {
                return strtoupper($matches[1]);
            },
            $value
        );
    }
}
