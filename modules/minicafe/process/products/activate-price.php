<?php

use Core\Database;

$db = new Database;
$product_price = $db->single('mc_product_prices', ['id' => $_GET['id']]);
$db->update('mc_product_prices',[
    'status' => 'NON ACTIVE'
], [
    'id' => ['<>',$_GET['id']],
    'product_id' => $product_price->product_id
]);

$db->update('mc_product_prices',[
    'status' => 'ACTIVE'
], [
    'id' => $_GET['id']
]);

$price = $db->single('mc_product_prices', ['id' => $_GET['id']]);

set_flash_msg(['success'=>"Harga berhasil diaktifkan"]);

header('location:'.routeTo('crud/index', ['table' => 'mc_product_prices', 'filter' => ['product_id' => $price->product_id]]));
die();