<?php

use Core\Page;
use Core\Route;

Route::additional_allowed_routes([
    'route_path' => '!crud/create?table=mc_orders',
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/edit?table=mc_orders',
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/delete?table=mc_orders',
]);

if(isset($_GET['filter']))
{
    $status = strtolower($_GET['filter']['status']) .'_orders';
    Page::setActive('minicafe.'.$status);
}