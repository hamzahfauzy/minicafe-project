<?php

$auth = auth();
$role = get_role($auth->id);

if(in_array(strtolower($role->name),['kitchen']))
{
    unset($fields['target_id']);
    unset($fields['customer_name']);
    unset($fields['table_name']);
    unset($fields['floor_name']);
}

return $fields;