<?php
function home()
{
	echo "Tipa home";
}

Router::get('^\/$', 'home');
Router::get('^\/home(\/?)$', 'home');
?>
