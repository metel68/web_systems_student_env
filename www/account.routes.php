<?php
session_start();
require_once 'index.php';
$r = Router::Instance();
function user_list($data)
{
	$data['Title'] = 'Список раков';
	$data['var']='';
	$i=1;
	foreach (scandir('/home/maximmi/web_systems_student_env/www') as $fname)
		{
			if (preg_match("^(\w+).lst$^",$fname))
			{
				$user=unserialize(file_get_contents($fname));
				$data['var'] .= $i." ".$user["name"]." ".$user["passwd"]."<br>";
				$i++;
			}
		}
	// $data['var'] = 'Crab<br>';
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
	if (file_exists($id.'.lst'))
	{
		$user=unserialize(file_get_contents($id.'.lst'));
		$data['var'] .= $user["name"]."<br>".$user["passwd"]."<br>";
	} else $data['var'] .= "не существует";
	return $data;
}

function user_auth($data)
{
	$data['Title'] = 'Вы краб';
		if (file_exists($_POST["name"].'.lst'))
			{
			$user=unserialize(file_get_contents($_POST["name"].'.lst'));
			if ($user["passwd"]==sha1($_POST["passwd"]))
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
$Fenom = initTemplate();
$data["Title"]="Регистрация";
$loginok=true;
if (!file_exists($_POST["name"].'.lst'))
{
	if ($_POST["passwd"] == $_POST["cpasswd"])
	{
		$data["var"] = $_POST["name"]."<br>".$_POST["passwd"];
		$user['name'] = $_POST["name"];
		$user['passwd'] = sha1($_POST["passwd"]);
		file_put_contents($_POST["name"].'.lst',serialize($user));
	}
	else
	{
		$data["var"] = "Пароли кагбэ не совпадают";
	}
}
else
{
	$data["var"] = "Этот логин уже занят";
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
$r->get('^\/user\/(\w+)$', 'user_view');
?>
