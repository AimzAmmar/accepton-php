<?php

namespace AcceptOn\Error;

class Error extends \Exception
{
    public static function curlEerror($curl)
    {
        try {
            $num = curl_errno($curl);
            $errorMessage = curl_error($curl);
            throw new \AcceptOn\Error\Error($errorMessage, $num);
        } catch (\AcceptOn\Error\Error $e) {
            throw $e;
        } catch (Exception $e) {
            return null;
        }
    }


    public static function fromResponse($responseBody, $statusCode, $previousException = null)
    {
        if (!isset(self::$errors[$statusCode])) {
            return null;
        }
        $errorClass = self::$errors[$statusCode];
        $message = self::parse_error($responseBody);
        throw new $errorClass($message, $statusCode, $previousException);
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
