<?php

if(isset($_GET['filter']))
{
    $role = strtolower($_GET['filter']['role_name']) .'s';
    return '<a href="'.routeTo("minicafe/$role/create").'" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</a>';
}

return '';