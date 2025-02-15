<?php

use Core\Route;

Route::additional_allowed_routes([
    'route_path' => '!crud/create?table=mc_order_items',
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/edit?table=mc_order_items',
]);

Route::additional_allowed_routes([
    'route_path' => '!crud/delete?table=mc_order_items',
]);
