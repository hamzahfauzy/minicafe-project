<?php

unset($fields['password']);

$fields['role_name'] = [
    'label' => __('default.menu.roles'),
    'type' => 'text',
    'search' => 'roles.name'
];

return $fields;