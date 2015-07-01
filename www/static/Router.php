<?php
include_once "account.routes.php";
include_once "home.routes.php";

class Router {

  private static $routes = array();
  public static $url;

 // private __constructor() {}

  public static function get($pattern, $callback) {
    self::set('GET', $pattern, $callback);
  }

  public static function post($pattern, $callback) {
    self::set('POST', $pattern, $callback);
  }

  private static function set($type, $pattern, $callback) {
    if (!function_exists($callback)) { 
      new Exception("Method $callback not exists"); 
      echo "Method $callback not exists";
    }
    self::$routes[$type][$pattern] = $callback;
  }


  public static function process($method, $uri) {
	  self::$url = $uri;
    if (!in_array($method, array('GET', 'POST'))) {
      new Exception("Request method should be GET or POST");
      echo "Request method should be GET or POST"; 
    } 

    // Выполнение роутинга
    // Используем роуты $routes['GET'] или $routes['POST']  в зависимости от метода HTTP.
    $active_routes = self::$routes[$method];

    // Для всех роутов 
    foreach ($active_routes as $pattern => $callback) {
      // Если REQUEST_URI соответствует шаблону - вызываем функцию
      //echo $pattern;
      if (preg_match_all("/$pattern/", $uri, $matches) ) {
        // вызываем callback
        $callback();
        // выходим из цикла
        break;
      }
      $matches = array();
    }
  }
}

?>
