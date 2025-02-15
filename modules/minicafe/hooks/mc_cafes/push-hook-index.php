<?php

use Core\Session;

$auth = auth();
$role = get_role($auth->id);
if($role->role_id != 1)
{
    $_GET['filter']['organization_id'] = Session::get('organization')->id;
}