<?php
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
	return $data;
}

function user_reg($data)
{
$Fenom = initTemplate();
$data["Title"]="Регистрация";
if ($_POST["passwd"] == $_POST["cpasswd"])
{
	$data["var"] = $_POST["name"]."<br>".$_POST["passwd"];
	$_SESSION['name'] = $_POST["name"];
	$_SESSION['passwd'] = sha1($_POST["passwd"]);
}
else
{
	$data["var"] = "Пароли кагбэ не совпадают";
}
	
return $data;
}

$r->post('^\/reg(\/?)$', 'user_reg');  
$r->get('^\/user(\/?)$', 'user_list');
$r->get('^\/user\/add$', 'user_add');
$r->get('^\/user\/(\d+)$', 'user_view');
?>
