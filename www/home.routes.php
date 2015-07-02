<?php
require_once 'index.php';
$r = Router::Instance();
function home($data)
{
	$Fenom = initTemplate();
	$data["Title"]="Главная";
	$data["var"]=$Fenom -> fetch('home.html', $data);
	return $data;
}

$r->get('^\/$', 'home');
$r->get('^\/home(\/?)$', 'home');
?>
