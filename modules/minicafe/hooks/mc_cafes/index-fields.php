<?php

$auth = auth();
$role = get_role($auth->id);
if($role->role_id == 1)
{
    $fields['organization_id'] = [
        'label' => 'Organization',
        'type' => 'options-obj:saas_organizations,id,name'
    ];
}

return $fields;