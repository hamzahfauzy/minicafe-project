<?php

use Core\Database;

$db = new Database;
$price = $db->single('mc_product_prices', ['product_id' => $_GET['product_id'], 'status' => 'ACTIVE']);;
return json_encode($price);
