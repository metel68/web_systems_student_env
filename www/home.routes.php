<?php
$r = Router::Instance();
function home(&$data)
{
	$data["Title"]="Главная";
	$data["var"]="Хрень или не хрень, вот в чем вопрос...";
	$data["page"] = "index.html";
}

$r->get('^\/$', 'home');
$r->get('^\/home(\/?)$', 'home');
?>
