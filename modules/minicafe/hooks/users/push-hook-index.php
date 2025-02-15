<?php

use Core\Page;

if(isset($_GET['filter']))
{
    $role = strtolower($_GET['filter']['role_name']) .'s';
    Page::setActive('minicafe.'.$role);
    Page::set_title(__('minicafe.label.'.$role));
}
