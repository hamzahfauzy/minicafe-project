<?php

use Core\Database;
use Core\Session;

$db = new Database;
$item = $db->single('mc_order_items', ['id' => $_GET['id']]);
$order = $db->single('mc_orders', ['id' => $item->order_id]);
$product = $db->single('mc_products', ['id' => $item->product_id]);
$logs = $item->logs ? json_decode($item->logs, 1) : [];
$logs[date('Y-m-d H:i:s')] = "DONE by " . auth()->name . " (".auth()->id.") at ". date('Y-m-d H:i:s');
$db->update('mc_order_items', [
    'status' => 'DONE',
    'logs'   => json_encode($logs)
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Pesanan berhasil diselesaikan"]);

try {
    //code...
    $data = [
        'cafe' => Session::get('employee')->cafe_id,
        'message' => 'Pesanan '.$product->name.' berhasil diselesaikan',
        'url' => routeTo('minicafe/orders/detail', ['code' => $order->code])
    ];
    
    simple_curl(env('SOCKET_URL', 'http://localhost:3000') . '/broadcast', 'POST', http_build_query($data), [
        'content-type: application/x-www-form-urlencoded'
    ]);
} catch (\Throwable $th) {
    throw $th;
}

header('location:'.routeTo('crud/index', ['table' => 'mc_order_items']));
die();