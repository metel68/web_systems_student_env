<?php
require_once 'fenom/src/Fenom.php';
include_once "account.routes.php";
include_once "home.routes.php";
require_once "menu.php";
Fenom::registerAutoload();
$Fenom = Fenom::factory('', 'cache/', array('auto_reload' => true));
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
    // Используем роуты $routes['GET'] или $routes['POST']  в зависимости от метода HTTP.
    $active_routes = $this->routes[$method];
	global $Fenom, $menu;
	$url=array();
	preg_match("^[a-zA-Z\s]+$^",$uri,$url);
	$data = array(
	'Title' => '404',
	'var' => 'Страница не найдена',
	'menu' => $menu,
	"url" => $url[0]
	);
    // Для всех роутов 
    foreach ($active_routes as $pattern => $callback) {
      // Если REQUEST_URI соответствует шаблону - вызываем функцию
      if (preg_match_all("/$pattern/", $uri, $matches)) {
        // вызываем callback
			if (isset($matches[1]))
			{
				$i=1;
				for ($i;$i<count($matches)-1;$i++)
				{
					$args[$i] = $matches[$i+1][0];
				}
			} else $args=array();
			$args[0]=$data;
				call_user_func_array($callback,$args);
        // выходим из цикла
        break;
      }
      $matches = array();
    }
  }
}
?>
