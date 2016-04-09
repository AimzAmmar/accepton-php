<?php

namespace AcceptOn\Error;

class Error extends \Exception
{
    public $message;
    public $statusCode;

    public function __construct($message, $statusCode)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    public static function errors()
    {
        return self::$errors;
    }

    public static function fromResponse($responseBody, $statusCode)
    {
        if (!isset(self::$errors[$statusCode])) {
            return null;
        }

        $errorClass = self::$errors[$statusCode];
        $message = self::parseError($responseBody);

        return new $errorClass($message, $statusCode);
    }

    private static function isErrorMessage($response)
    {
        return $response && isset($response->error) && isset($response->error->message);
    }

    private static function parseError($responseBody)
    {
        $object = json_decode($responseBody);

        if (self::isErrorMessage($object)) {
            return $object->error->message;
        } else {
            return "";
        }
    }

    private static $errors = array(
        400 => "\AcceptOn\Error\BadRequest",
        401 => "\AcceptOn\Error\Unauthorized",
        500 => "\AcceptOn\Error\InternalServerError",
        502 => "\AcceptOn\Error\BadGateway",
        503 => "\AcceptOn\Error\ServiceUnavailable",
        504 => "\AcceptOn\Error\GatewayTimeout"
    );
}
