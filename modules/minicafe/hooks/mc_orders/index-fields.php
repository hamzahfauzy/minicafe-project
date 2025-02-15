<?php

$auth = auth();
$role = get_role($auth->id);

if(in_array(strtolower($role->name),['operator','waiter','kitchen']))
{
    unset($fields['cafe_id']);
}

return $fields;