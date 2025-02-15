<?php

use Core\Database;

$db = new Database;
$item = $db->single('mc_order_items', ['id' => $_GET['id']]);
$logs = $item->logs ? json_decode($item->logs, 1) : [];
$logs[date('Y-m-d H:i:s')] = "CLOSE by " . auth()->name . " (".auth()->id.") at ". date('Y-m-d H:i:s');
$db->update('mc_order_items', [
    'status' => 'CLOSE',
    'logs'   => json_encode($logs)
], [
    'id' => $_GET['id']
]);

$checker = $db->exists('mc_order_items', [
    'status' => ['<>', 'CLOSE'],
    'order_id' => $item->order_id
]);

if(!$checker)
{
    $db->update('mc_orders',[
        'status' => 'FINISH'
    ], ['id' => $item->order_id]);
}

set_flash_msg(['success'=>"Pesanan berhasil disajikan"]);

header('location:'.routeTo('crud/index', ['table' => 'mc_order_items']));
die();