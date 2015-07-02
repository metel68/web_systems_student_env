<?php
require_once "Router.php";
$r = Router::Instance();
function user_list(&$data)
{
	$data['Title'] = 'Главная';
	$data['var'] = 'Crab<br>';
	$data["page"] = "index.html";
	$i=0;
	for ($i;$i<6;$i++)
	{
		$data["var"].=$data["var"];
	}
}
function user_add(&$data)
{
	echo "User addition is not implemented";
}
function user_view(&$data,$id)
{
	echo "User $id";
}
  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
