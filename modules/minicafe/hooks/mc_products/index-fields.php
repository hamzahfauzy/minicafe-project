<?php

$auth = auth();

if(get_role($auth->id)->name == 'Operator')
{
    unset($fields['cafe_id']);
}

return $fields;