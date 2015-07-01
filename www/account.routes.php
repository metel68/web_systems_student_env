<?php
require_once "Router.php";
$r = Router::Instance();
function user_list()
{
	echo "User list";
}
function user_add()
{
	echo "User addition is not implemented";
}
function user_view($id)
{
	echo "User $id[0]";
}
  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
