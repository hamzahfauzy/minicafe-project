<?php

use Core\Database;

$db = new Database;

$db->update('mc_orders', [
    'status' => 'CANCEL',
    'logs'   => json_encode($logs)
], [
    'code' => $_GET['code']
]);

set_flash_msg(['success' => "Pesanan berhasil dicancel"]);

header('location:' . routeTo('crud/index', ['table' => 'mc_orders']));
die();
