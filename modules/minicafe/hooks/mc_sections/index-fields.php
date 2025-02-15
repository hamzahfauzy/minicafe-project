<?php


$auth = auth();

if(get_role($auth->id)->role_id != 1)
{
    unset($fields['organization_id']);
}

return $fields;