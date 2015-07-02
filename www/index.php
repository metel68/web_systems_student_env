<?php
include_once 'Router.php';
require_once 'fenom/src/Fenom.php';
Fenom::registerAutoload();
    $Fenom = Fenom::factory('', 'cache/', array('auto_reload' => true));
	$r = Router::Instance();
	$menu = array('home'=>'Home','user'=>'Users list');
	preg_match("^[a-zA-Z\s]+$^",$_SERVER['REQUEST_URI'],$url);
	$data = array(
		'Title' => '404',
		'var' => 'Страница не найдена',
		'page' => 'index.html',
		"url" =>  $url[0],
		"menu" => $menu
	);
	$data = $r->process($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $data);
	$menu = array('home'=>'Home','user'=>'Users list');
$Fenom -> display($data["page"], $data);
//echo $_SERVER['REQUEST_METHOD'];
?>
