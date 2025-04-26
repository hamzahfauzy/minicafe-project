<?php

$_GET['table'] = 'users';
$_GET['filter'] = [
    'role_name' => 'Cashier'
];
$module = 'minicafe';
return require '../modules/crud/process/index.php';