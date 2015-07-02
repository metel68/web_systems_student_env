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
	echo "User addition is not implemented";
	return $data;
}
function user_view($data,$id)
{
	echo "User $id";
	return $data;
}
  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
