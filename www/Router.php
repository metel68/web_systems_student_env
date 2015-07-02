<?php
include_once "account.routes.php";
include_once "home.routes.php";

class Router {

  private $routes = null;
  private static $_instance = null;

  private function __constructor() {
    $this->routes = array();
  }

  public static function Instance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new Router();
    }
    return self::$_instance;
  } 


  public function get($pattern, $callback) {
    $this->set('GET', $pattern, $callback);
  }

  public function post($pattern, $callback) {
    $this->set('POST', $pattern, $callback);
  }

  private function set($type, $pattern, $callback) {
    if (!function_exists($callback)) { 
      new Exception("Method $callback not exists"); 
    }
    $this->routes[$type][$pattern] = $callback;
  }


  public function process($method, $uri, $data) {
    if (!in_array($method, array('GET', 'POST'))) {
      new Exception("Request method should be GET or POST"); 
    }
    // Выполнение роутинга
    // Используем роуты $routes['GET'] или $routes['POST']  в зависимости от метода HTTP.
    $active_routes = $this->routes[$method];
	$url=array();
	$matches=array();
	$args=array();
    // Для всех роутов 
    foreach ($active_routes as $pattern => $callback) {
      // Если REQUEST_URI соответствует шаблону - вызываем функцию
      if (preg_match_all("/$pattern/", $uri, $matches)) {
        // вызываем callback
       	$args[0]=&$data;
			if (isset($matches[1]))
			{
				$i=1;
				for ($i;$i<count($matches);$i++)
				{
					$args[$i] = $matches[$i][0];
				}
			}
			return call_user_func_array($callback,$args);
      }
    }
  }
}
?>
