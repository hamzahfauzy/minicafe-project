<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Core\Session;

$db = new Database;
$tableName = 'mc_orders';
$module = 'minicafe';
$error_msg  = get_flash_msg('error');
$success_msg  = get_flash_msg('success');
$old        = get_flash_msg('old');
$code = $_GET['code'];

$db->query = "SELECT $tableName.*, mc_customers.name customer_name FROM $tableName LEFT JOIN mc_customers ON mc_customers.id = $tableName.customer_id WHERE $tableName.code = '$code'";
$order = $db->exec('single');

if (Request::isMethod('POST')) {
    $product = $db->single('mc_products', ['id' => $_POST['product']]);
    $db->insert('mc_order_items', [
        'order_id' => $order->id,
        'target_id' => $product->target_id,
        'product_id' => $product->id,
        'qty' => $_POST['qty']
    ]);

    set_flash_msg(['success' => "Pesanan berhasil ditambahkan"]);

    try {

        $dt = [
            'cafe' => Session::get('employee')->cafe_id,
            'target' => $product->target_id,
            'message' => 'Pesanan baru ' . $product->name . ' sejumlah ' . $_POST['qty'],
            'url' => routeTo('minicafe/orders/detail', ['code' => $code])
        ];

        simple_curl('http://localhost:3000/broadcast', 'POST', http_build_query($dt), [
            'content-type: application/x-www-form-urlencoded'
        ]);
    } catch (\Throwable $th) {
        throw $th;
    }

    header('location:' . routeTo('minicafe/orders/detail', ['code' => $_GET['code']]));
    die();
}

$db->query = "SELECT 
                mc_order_items.*, 
                users.name target_name, 
                mc_products.name product_name, 
                mc_products.category_id,
                mc_categories.name category_name
              FROM mc_order_items 
              LEFT JOIN users ON users.id = mc_order_items.target_id 
              LEFT JOIN mc_products ON mc_products.id = mc_order_items.product_id 
              LEFT JOIN mc_categories ON mc_categories.id = mc_products.category_id 
              WHERE mc_order_items.order_id = $order->id
              ORDER BY category_id";
$order->items = $db->exec('all');

$db->query = "SELECT 
                mc_products.*, 
                CONCAT(mc_products.name,' - ',mc_categories.name) name,
                users.name target_name
              FROM mc_products 
              LEFT JOIN mc_categories ON mc_categories.id = mc_products.category_id
              LEFT JOIN users ON users.id = mc_products.target_id";
$products = $db->exec('all');

// page section
$title = 'Detail Pesanan ' . $_GET['code'];
Page::setActive("minicafe.orders.detail");
Page::setTitle($title);
Page::setModuleName($module);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => '#',
        'title' => 'Data Pesanan'
    ],
    [
        'title' => $title
    ]
]);
$app = [
    'name' => env('APP_CAFE_NAME', ''),
    'address' => env('APP_CAFE_ADDRESS', ''),
    'footer' => env('APP_CAFE_FOOTER', ''),
];
Page::pushFoot("<script>window.app = " . json_encode($app) . "</script>");
Page::pushFoot("<script src='" . asset('assets/minicafe/js/print.js') . "'></script>");
Page::pushFoot("<script>function printToThermal(){ var order = " . json_encode($order) . "; doPrint(order); }</script>");

return view('minicafe/views/orders/detail', compact('error_msg', 'success_msg', 'old', 'order', 'products'));
