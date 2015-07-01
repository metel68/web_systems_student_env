<?php
Router::get('^\/pocket(\/?)$', 'pockets_list');
Router::get('^\/pocket\/(\d+)$', 'pocket_view');

Router::post('^\/pocket\/(\d+)\/sum$', 'pocket_sum');
Router::post('^\/pocket\/(\d+)\/divide$', 'pocket_divide');
Router::post('^\/pocket\/(\d+)\/subtract$', 'pocket_subtract');
Router::post('^\/pocket\/(\d+)\/multiply$', 'pocket_multiply');
?>
