<?php

if(isset($_GET['filter']) && isset($_GET['filter']['product_id']))
{
    unset($fields['product_id']);
}
unset($fields['status']);

return $fields;