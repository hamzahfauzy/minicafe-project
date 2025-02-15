<?php

use Core\Database;
use Core\Session;

$db = new Database;
$cafes = $db->all('mc_cafes', [
    'organization_id' => Session::get('organization')->id
]);

$cafeOptions = [];
foreach($cafes as $option)
{
    $cafeOptions[$option->name] = $option->id;
}

$fields['cafe'] = [
    'label' => 'Cafe',
    'type' => 'options:'.json_encode($cafeOptions)
];

return $fields;