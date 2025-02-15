<?php

$_GET['table'] = 'users';
$_GET['filter'] = [
    'role_name' => 'Operator'
];
$module = 'minicafe';
return require '../modules/crud/process/index.php';