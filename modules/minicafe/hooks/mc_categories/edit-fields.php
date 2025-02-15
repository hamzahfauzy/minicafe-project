<?php

use Core\Session;

$auth = auth();

if(get_role($auth->id)->role_id != 1)
{
    $fields['section_id']['type'] .= '|organization_id,'.Session::get('organization')->id;
    unset($fields['organization_id']);
}

return $fields;