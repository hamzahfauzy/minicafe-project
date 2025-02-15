<?php

use Core\Session;

if(!isset($data['cafe_id']))
{
    $data['cafe_id'] = Session::get('employee')->cafe_id;
}