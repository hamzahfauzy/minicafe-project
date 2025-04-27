<?php

use Core\Database;

$db = new Database;
$item = $db->single('mc_order_items', ['id' => $_GET['id']]);
$db->delete('mc_order_items', [
    'id' => $_GET['id']
]);
set_flash_msg(['success' => "Item berhasil dihapus"]);

header('Location: ' . $_SERVER['HTTP_REFERER']);
die();
