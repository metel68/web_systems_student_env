<?php
include_once 'Router.php';
$r = Router::Instance();
$r->process($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
//echo $_SERVER['REQUEST_METHOD'];
?>
