<?php
require_once 'index.php';
$r = Router::Instance();
function user_list($data)
{
	$data['Title'] = 'Главная';
	$data['var'] = 'Crab<br>';
	$i=0;
	for ($i;$i<6;$i++)
	{
		$data["var"].=$data["var"];
	}
	return $data;
}
function user_add($data)
{
	$Fenom = initTemplate();
	$data["Title"]="Регистрация";
	$data["var"] = $Fenom -> fetch('reg.html', $data);
	return $data;
}
function user_view($data,$id)
{
	$data['Title'] = 'Список раков';
	$data['var'] = "User $id";
	return $data;
}
  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
