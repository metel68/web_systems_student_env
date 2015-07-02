<?php
require_once "Router.php";
$r = Router::Instance();
function user_list($data)
{
	global $Fenom;
	$data['Title'] = 'Главная';
	$data['var'] = 'Crab<br>';
	$i=0;
	for ($i;$i<6;$i++)
	{
		$data["var"].=$data["var"];
	}
	
	$Fenom -> display('index.html', $data);
}
function user_add()
{
	echo "User addition is not implemented";
}
function user_view($id)
{
	echo "User $id";
}
  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
