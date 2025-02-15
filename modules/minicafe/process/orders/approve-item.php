<?php

use Core\Database;

$db = new Database;
$item = $db->single('mc_order_items', ['id' => $_GET['id']]);
$logs = $item->logs ? json_decode($item->logs) : [];
$logs[date('Y-m-d H:i:s')] = "APPROVE by " . auth()->name . " (".auth()->id.") at ". date('Y-m-d H:i:s');
$db->update('mc_order_items', [
    'status' => 'ON PROGRESS',
    'logs'   => json_encode($logs)
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Pesanan berhasil disetujui"]);

header('location:'.routeTo('crud/index', ['table' => 'mc_order_items']));
die();