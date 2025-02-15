<?php

use Core\Database;
use Core\Page;
use Core\Request;
use Core\Session;

$db = new Database;
$tableName = 'mc_orders';
$module = 'minicafe';
$error_msg  = get_flash_msg('error');
$old        = get_flash_msg('old');
$cafe_id = Session::get('employee')->cafe_id;

if(Request::isMethod('POST'))
{
    $data = isset($_POST[$tableName]) ? $_POST[$tableName] : [];
    if(empty($data['customer_id']))
    {
        // unset($data['customer_id'])
        $customer = $db->insert('mc_customers', [
            'name' => $_POST['customer_name'],
            'cafe_id' => $cafe_id,
        ]);

        $data['customer_id'] = $customer->id;
    }
    $items = $_POST['items'];
    $data['cafe_id'] = $cafe_id;
    $data['total_items'] = count($items);
    $data['total_qty'] = array_sum(array_column($items, 'qty'));
    $order = $db->insert($tableName, $data);

    foreach($items as $index => $item)
    {
        $item['order_id'] = $order->id;
        $db->insert('mc_order_items', $item);
    }

    set_flash_msg(['success'=>"Pesanan berhasil ditambahkan"]);

    header('location:'.routeTo('minicafe/orders/detail', ['code' => $data['code']]));
    die();
}

$db->query = "SELECT COUNT(*) as `counter` FROM mc_orders WHERE created_at LIKE '%".date('Y-m')."%' AND cafe_id = $cafe_id";
$counter = $db->exec('single')?->counter ?? 0;

$counter = sprintf("%05d", $counter+1);
$code    = 'INV' . date('Ym'). $counter;

$employee = Session::get('employee');

$db->query = "SELECT 
                mc_products.*, 
                CONCAT(mc_products.name,' - ',mc_categories.name) name,
                users.name target_name
              FROM mc_products 
              LEFT JOIN mc_categories ON mc_categories.id = mc_products.category_id
              LEFT JOIN users ON users.id = mc_products.target_id
              WHERE mc_products.cafe_id = $employee->cafe_id";
$products = $db->exec('all');

$customers = $db->all('mc_customers', [
    'cafe_id' => $employee->cafe_id
]);

// page section
$title = 'Pesanan Baru';
Page::setActive("minicafe.orders.create");
Page::setTitle($title);
Page::setModuleName($title);
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


Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<script src="https://cdn.tiny.cloud/1/rsb9a1wqmvtlmij61ssaqj3ttq18xdwmyt7jg23sg1ion6kn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>');
Page::pushHead("<script>
tinymce.init({
  selector: 'textarea:not(.select2-search__field)',
  relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});
</script>");

Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");
Page::pushFoot("<script>var items = []</script>");
Page::pushFoot("<script src='".asset('assets/minicafe/js/order.js')."'></script>");
Page::pushFoot("<script>$('.select2insidemodal').select2({dropdownParent: $('#itemModal .modal-body')});$('.select2insidemodal2').select2({dropdownParent: $('#customerModal .modal-body')});</script>");

Page::pushHook('create');

return view('minicafe/views/orders/create', compact('error_msg','old','tableName','code','products','customers'));