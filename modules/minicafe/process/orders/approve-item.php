<?php

use Core\Database;
use Core\Session;

$db = new Database;
$item = $db->single('mc_order_items', ['id' => $_GET['id']]);
$logs = $item->logs ? json_decode($item->logs) : [];
$logs[date('Y-m-d H:i:s')] = "APPROVE by " . auth()->name . " (" . auth()->id . ") at " . date('Y-m-d H:i:s');
$db->update('mc_order_items', [
    'status' => 'ON PROGRESS',
    'logs'   => json_encode($logs)
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success' => "Pesanan berhasil disetujui"]);

try {

    $order = $db->single('mc_orders', ['id' => $item->order_id]);
    $product = $db->single('mc_products', ['id' => $item->product_id]);

    $dt = [
        'cafe' => Session::get('employee')->cafe_id,
        'message' => 'Pesanan ' . $product->name . ' berhasil disetujui',
        'url' => routeTo('minicafe/orders/detail', ['code' => $order->code])
    ];

    simple_curl(env('SOCKET_URL', 'http://localhost:3000') . '/broadcast', 'POST', http_build_query($dt), [
        'content-type: application/x-www-form-urlencoded'
    ]);
} catch (\Throwable $th) {
    throw $th;
}

header('location:' . routeTo('crud/index', ['table' => 'mc_order_items']));
die();
