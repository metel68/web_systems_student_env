<?php
session_start();
require_once 'index.php';
$r = Router::Instance();
function user_list($data)
{
	$users=unserialize(file_get_contents('users.lst'));
	$data['Title'] = 'Список раков';
	$data['var']='';
	if (isset($users))
	{
		foreach ($users as $user)
		{
			$data['var'] .= $user["id"].' '.$user["name"]."<br>".$user["passwd"]."<br>";
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
	$users=unserialize(file_get_contents('users.lst'));
	$data['Title'] = 'Список раков';
	$data['var'] = "User $id <br>";
	if (isset($users[$id]))
	{
		$user=$users[$id];
		$data['var'] .= $user["name"]."<br>".$user["passwd"]."<br>";
	} else $data['var'] .= "не существует";
	return $data;
}

function user_auth($data)
{
	$users=unserialize(file_get_contents('users.lst'));
	$data['Title'] = 'Вы краб';
	foreach($users as $user)
	{
		if ($user["name"]==$_POST["name"] && $user["passwd"]==sha1($_POST["passwd"]))
		{
			$_SESSION['activeuser'] = $user["name"];
			$data['var'] = "Вход выполнен под именем ".$user["name"];
		}
	} 
	if ($_SESSION["activeuser"] == '')
	{
		$data['var'] = "Чего-то вы не так ввели...";
	}
	return $data;
}

function user_reg($data)
{
$users=unserialize(file_get_contents('users.lst'));
$Fenom = initTemplate();
$data["Title"]="Регистрация";
if ($_POST["passwd"] == $_POST["cpasswd"])
{
	if (!isset($users["count"])) {
		$users["count"] = 1;
	}
	else
	{
		$users["count"]++;
	}
	$id = $users["count"];
	$users[$id]["id"] = $users["count"];
	$data["var"] = $_POST["name"]."<br>".$_POST["passwd"];
	$users[$id]['name'] = $_POST["name"];
	$users[$id]['passwd'] = sha1($_POST["passwd"]);
	file_put_contents('users.lst',serialize($users));
}
else
{
	$data["var"] = "Пароли кагбэ не совпадают";
}
	
return $data;
}

function user_logout($data)
{
	$data['Title'] = 'Вы краб';
	$data["var"] = "Вы успешно вышли <p><br></p><img src='/Peka_namekaet.jpg'>";
	session_destroy();
	return $data;
}

$r->post('^\/reg(\/?)$', 'user_reg');  
$r->post('^\/auth(\/?)$', 'user_auth');  
$r->get('^\/logout(\/?)$', 'user_logout');  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
//$r->get('^\/user\/del$', 'user_del');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
