<?php
include_once 'Router.php';
// вызывает {module}.routes.php
//modules_load_routes();
$r = Router::Instance();
$r->process($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
//echo $_SERVER['REQUEST_METHOD'];
?>
