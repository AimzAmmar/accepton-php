<?php

namespace AcceptOn\Error;

class Error extends \Exception {

  private static $errors = array(
    400 => "\AcceptOn\Error\BadRequest",
    401 => "\AcceptOn\Error\Unauthorized",
    500 => "\AcceptOn\Error\InternalServerError",
    502 => "\AcceptOn\Error\BadGateway",
    503 => "\AcceptOn\Error\ServiceUnavailable",
    504 => "\AcceptOn\Error\GatewayTimeout"
  );

  public static function curl_error($curl) {
    try {
      $num = curl_errno($curl);
      $error_message = curl_error($curl);
      throw new \AcceptOn\Error\Error($error_message, $num);
    } catch (\AcceptOn\Error\Error $e) {
      throw $e;
    } catch (Exception $e) {
      return null;
    }
  }


  public static function from_response($response_body, $status_code, $exception_previous = null) {
    if (!isset(self::$errors[$status_code])) return null;
    $errorClass = self::$errors[$status_code];
    $message = self::parse_error($response_body);
    throw new $errorClass($message, $status_code, $exception_previous);
  }

  private static function parse_error($response_body) {
    try {
      $obj = json_decode($response_body);
      return $obj->error->message;
    } catch (Exception $e) {
      return '';
    }
  }

}

class ClientError extends \AcceptOn\Error\Error {}
class BadRequest extends ClientError {}
class Unauthorized extends ClientError {}
class ServerError extends \AcceptOn\Error\Error {}
class InternalServerError extends ServerError {}
class BadGateway extends ServerError {}
class ServiceUnavailable extends ServerError {}
class GatewayTimeout extends ServerError {}
