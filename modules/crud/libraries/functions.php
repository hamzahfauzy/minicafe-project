<?php

use Core\Page;

function crudRoute($path, $tableName)
{
    $params = ['table' => $tableName];
    if(isset($_GET['filter']))
    {
        $params['filter'] = $_GET['filter'];
    }
    return routeTo($path, $params);
}

// echo startWith('crud/index', 'crud/');

Page::pushHead('<link rel="stylesheet" href="'.asset('assets/crud/css/styles.css').'" />');