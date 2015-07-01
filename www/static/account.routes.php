<?php
require_once "Router.php";
function user_list()
{
	echo "User_list";
}
function user_view()
{
	echo "User_";
	preg_match("^(?:\d*\.)?\d+^", Router::$url, $matches);
	echo $matches[0];
}  
Router::get('^\/user(\/?)$', 'user_list');
Router::get('^\/user\/(\d+)$', 'user_view');
/*
Router::post('^\/account\/(\d+)\/sum$', 'account_sum');
Router::post('^\/account\/(\d+)\/divide$', 'account_divide');
Router::post('^\/account\/(\d+)\/subtract$', 'account_subtract');
Router::post('^\/account\/(\d+)\/multiply$', 'account_multiply');
*/
?>
