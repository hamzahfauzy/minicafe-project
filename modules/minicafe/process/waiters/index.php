<?php

$_GET['table'] = 'users';
$_GET['filter'] = [
    'role_name' => 'Waiter'
];
$module = 'minicafe';
return require '../modules/crud/process/index.php';