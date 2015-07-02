<?php
require_once 'fenom/src/Fenom.php';
include_once "account.routes.php";
include_once "home.routes.php";
require_once "menu.php";
Fenom::registerAutoload();
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


  public function process($method, $uri) {
    if (!in_array($method, array('GET', 'POST'))) {
      new Exception("Request method should be GET or POST"); 
    }
    // Выполнение роутинга
    $Fenom = Fenom::factory('', 'cache/', array('auto_reload' => true));
    // Используем роуты $routes['GET'] или $routes['POST']  в зависимости от метода HTTP.
    $active_routes = $this->routes[$method];
	$url=array();
	$matches=array();
	$args=array();
	$menu = array('home'=>'Home','user'=>'Users list');
	preg_match("^[a-zA-Z\s]+$^",$uri,$url);
	$data = array(
		'Title' => '404',
		'var' => 'Страница не найдена',
		'page' => 'index.html',
		"url" => $url[0],
		"menu" => $menu
	);
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
			call_user_func_array($callback,$args);
        // выходим из цикла
        break;
      }
    }
      $Fenom -> display($data["page"], $data);
  }
}
?>
