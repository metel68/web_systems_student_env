<?php
$r = Router::Instance();
function home($data)
{
	global $Fenom;
	$data["Title"]="Главная";
	$data["var"]="Хрень или не хрень, вот в чем вопрос...";
	$Fenom -> display('index.html', $data);
}

$r->get('^\/$', 'home');
$r->get('^\/home(\/?)$', 'home');
?>
