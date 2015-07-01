<?php
$r = Router::Instance();
function home()
{
	echo "Tipa home";
}

$r->get('^\/$', 'home');
$r->get('^\/home(\/?)$', 'home');
?>
