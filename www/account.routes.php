<?php
session_start();
require_once 'index.php';
$r = Router::Instance();
function user_list($data)
{
	$data['Title'] = 'Главная';
	$data['var'] = isset($_SESSION["name"]) ? $_SESSION["name"]."<br>".$_SESSION["passwd"] : "Crab<br>";
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

function user_auth($data)
{
	$data['Title'] = 'Вы краб';
	if ($_SESSION["name"]==$_POST["name"] && $_SESSION["passwd"]==sha1($_POST["passwd"]))
	{
		$_SESSION['logged'] = 1;
		$data['var'] = "Вход выполнен под именем ".$_SESSION["name"];
	} 
	else
	{
		$data['var'] = "Чего-то вы не так ввели...";
	}
	return $data;
}

function user_reg($data)
{
$Fenom = initTemplate();
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
$data["Title"]="Регистрация";
if ($_POST["passwd"] == $_POST["cpasswd"])
{
	$data["var"] = $_POST["name"]."<br>".$_POST["passwd"];
	$_SESSION[ $_SESSION['count']]['name'] = $_POST["name"];
	$_SESSION[ $_SESSION['count']]['passwd'] = sha1($_POST["passwd"]);
}
else
{
	$data["var"] = "Пароли кагбэ не совпадают";
}
	
return $data;
}

function user_del($data)
{
	$data['Title'] = 'Вы краб';
	$data["var"] = "Вы успешно вышли... насовсем xDD <p><br></p><img src='/Peka_namekaet.jpg'>";
	session_destroy();
	return $data;
}

$r->post('^\/reg(\/?)$', 'user_reg');  
$r->post('^\/auth(\/?)$', 'user_auth');  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/del$', 'user_del');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
