<?php

namespace AcceptOn;

trait Utils {

  private function perform_get_with_object($path, $params, $klass) {
    return $this->perform_request_with_object("get", $path, $params, $klass);
  }

  private function perform_post_with_object($path, $params, $klass) {
    return $this->perform_request_with_object("post", $path, $params, $klass);
  }

  private function perform_request($request_method, $path, $params) {
    $request = new \AcceptOn\Request($this, $request_method, $path, $params);
    return $request->perform();
  }

  private function perform_request_with_object($request_method, $path, $params, $klass) {
    $response = $this->perform_request($request_method, $path, $params);
    return new $klass($response);
  }

  private function with_environment($params) {
    $params['environment'] = $this->environment;
  }

  public static function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
  }

  public static function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
  }

}
