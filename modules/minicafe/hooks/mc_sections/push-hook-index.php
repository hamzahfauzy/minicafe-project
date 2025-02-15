<?php

use Core\Session;

$auth = auth();

if(get_role($auth->id)->role_id != 1)
{
    $_GET['filter']['organization_id'] = Session::get('organization')->id;
}