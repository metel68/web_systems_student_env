<?php
session_start();
require_once 'index.php';
$r = Router::Instance();
function user_list($data)
{
	$data['Title'] = 'Список раков';
	$data['var']='';
	//print_r($_SESSION);
	if (isset($_SESSION["users"]))
	{
		foreach ($_SESSION["users"] as $key => $user)
		{
			$data['var'] .= $key.' '.$user["name"]."<br>".$user["passwd"]."<br>";
		}
	} else $data['var'] = 'Crab<br>';
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
	$data['var'] = "User $id <br>";
	if (isset($_SESSION["users"][$id]))
	{
		$user=$_SESSION["users"][$id];
		$data['var'] .= $user["name"]."<br>".$user["passwd"]."<br>";
	} else $data['var'] .= "не существует";
	return $data;
}

function user_auth($data)
{
	$data['Title'] = 'Вы краб';
	foreach($_SESSION["users"] as $user)
	{
		if ($user["name"]==$_POST["name"] && $user["passwd"]==sha1($_POST["passwd"]))
		{
			$_SESSION['logged'] = 1;
			$_SESSION['activeuser'] = $user["name"];
			$data['var'] = "Вход выполнен под именем ".$user["name"];
		}
	} 
	if (!$_SESSION["logged"])
	{
		$data['var'] = "Чего-то вы не так ввели...";
	}
	return $data;
}

function user_reg($data)
{
$Fenom = initTemplate();
$data["Title"]="Регистрация";
if ($_POST["passwd"] == $_POST["cpasswd"])
{
	if (!isset($_SESSION['count'])) {
		$_SESSION['count'] = 1;
	}
	else
	{
		$_SESSION['count']++;
	}
	$id = $_SESSION['count'];
	$_SESSION["users"][$id]["id"] = $_SESSION['count'];
	$data["var"] = $_POST["name"]."<br>".$_POST["passwd"];
	$_SESSION["users"][$id]['name'] = $_POST["name"];
	$_SESSION["users"][$id]['passwd'] = sha1($_POST["passwd"]);
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
	$data["var"] = "Вы успешно вышли... насовсем... вместе со всем сервером xDD <p><br></p><img src='/Peka_namekaet.jpg'>";
	session_destroy();
	return $data;
}

function user_logout($data)
{
	$data['Title'] = 'Вы краб';
	$data["var"] = "Вы успешно вышли..."; 
	$_SESSION["logged"]=0;
	$_SESSION["activeuser"]='';
	return $data;
}

$r->post('^\/reg(\/?)$', 'user_reg');  
$r->post('^\/auth(\/?)$', 'user_auth');  
$r->get('^\/logout(\/?)$', 'user_logout');  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/del$', 'user_del');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
