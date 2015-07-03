<?php
include_once 'Router.php';
require_once 'fenom/src/Fenom.php';

function initTemplate()
{
	Fenom::registerAutoload();
    $Fenom = Fenom::factory('', 'cache/', array('auto_reload' => true));
    return $Fenom;
}
	$Fenom = initTemplate();
	$r = Router::Instance();
	$menu = array('home'=>'Home','user'=>'Users list', 'user/add'=>'Add user', "logout" => 'Log out', "user/del" => "<font color='red'>Exterminatus</font>");
	preg_match("^[a-zA-Z\s]+$^",$_SERVER['REQUEST_URI'],$url);
	$data = array(
		'Title' => '404',
		'var' => 'Страница не найдена',
		"url" =>  isset($url[0]) ? $url[0] : "home",
		"menu" => $menu,
		"logged" => isset($_SESSION["logged"]) ? $_SESSION["logged"] : 0,
		"name" => isset($_SESSION["activeuser"]) ? $_SESSION["activeuser"] : 'error'
	);
	$data = $r->process($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $data);
	$menu = array('home'=>'Home','user'=>'Users list');
$Fenom -> display('index.html', $data);
//echo $_SERVER['REQUEST_METHOD'];
?>
