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
function user_view($id, $id2, $id3, $id4)
{
	echo "User $id : $id2 - $id3 + $id4";
}
  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)\/(\d+)\/(\d+)\/(\d+)$', 'user_view');
?>
