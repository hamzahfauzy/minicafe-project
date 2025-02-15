<?php

use Core\Database;
use Core\Session;

$auth = auth();

if(get_role($auth->id)->name == 'Owner')
{
    $organization = Session::get('organization');
    $fields['category_id']['type'] .= '|organization_id,'.$organization->id;
    $fields['cafe_id']['type'] .= '|organization_id,'.$organization->id;
}

if(get_role($auth->id)->name == 'Operator')
{
    unset($fields['cafe_id']);
}


return $fields;