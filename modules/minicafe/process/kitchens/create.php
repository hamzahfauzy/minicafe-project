<?php

$_GET['table'] = 'users';
$_GET['filter'] = [
    'role_name' => 'Kitchen'
];
$module = 'minicafe';
$actionHooks = 'create';
return require '../modules/crud/process/create.php';