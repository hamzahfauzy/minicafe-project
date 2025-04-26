<?php 

return [
    'mc_cafes' => [
        'name' => [
            'type' => 'text',
            'label' => 'Nama'
        ],
        'phone' => [
            'type' => 'text',
            'label' => 'No. HP'
        ],
        'address' => [
            'type' => 'text',
            'label' => 'Alamat'
        ],
        'invoice_footer_text' => [
            'type' => 'text',
            'label' => 'Teks Footer Invoice'
        ],
        '_userstamp' => true
    ],
    'mc_customers' => [
        'cafe_id' => [
            'type' => 'options-obj:mc_cafes,id,name',
            'label' => 'Cafe'
        ],
        'name' => [
            'type' => 'text',
            'label' => 'Nama'
        ],
        'phone' => [
            'type' => 'text',
            'label' => 'No. HP'
        ],
        'address' => [
            'type' => 'text',
            'label' => 'Alamat'
        ],
        '_userstamp' => true
    ],
    'mc_sections' => [
        'organization_id' => [
            'type' => 'options-obj:saas_organizations,id,name',
            'label' => 'Organisasi'
        ],
        'name' => [
            'type' => 'text',
            'label' => 'Nama'
        ],
        '_userstamp' => true
    ],
    'mc_categories' => [
        'organization_id' => [
            'type' => 'options-obj:saas_organizations,id,name',
            'label' => 'Organisasi'
        ],
        'section_id' => [
            'type' => 'options-obj:mc_sections,id,name',
            'label' => 'Bagian'
        ],
        'name' => [
            'type' => 'text',
            'label' => 'Nama'
        ],
        '_userstamp' => true
    ],
    'mc_products' => [
        'cafe_id' => [
            'type' => 'options-obj:mc_cafes,id,name',
            'label' => 'Cafe'
        ],
        'category_id' => [
            'type' => 'options-obj:mc_categories,id,name',
            'label' => 'Kategori'
        ],
        'target_id' => [
            'type' => 'options-obj:users,id,name',
            'label' => 'Tujuan'
        ],
        'name' => [
            'type' => 'text',
            'label' => 'Nama'
        ],
        '_userstamp' => true
    ],
    'mc_product_prices' => [
        'product_id' => [
            'label' => 'Product',
            'type' => 'options-obj:mc_products,id,name'
        ],
        'price' => [
            'label' => 'Harga',
            'type' => 'number'
        ],
        'status' => [
            'label' => 'Status',
            'type' => 'text'
        ]
    ],
    'mc_orders' => [
        'cafe_id' => [
            'type' => 'options-obj:mc_cafes,id,name',
            'label' => 'Cafe'
        ],
        'customer_id' => [
            'type' => 'options-obj:mc_customers,id,name',
            'label' => 'Kustomer'
        ],
        'code' => [
            'type' => 'text',
            'label' => 'No. Pesanan'
        ],
        'status' => [
            'type' => 'text',
            'label' => 'Status'
        ],
        '_userstamp' => true
    ],
    'mc_order_items' => [
        'code' => [
            'type' => 'text',
            'label' => 'No. Pesanan',
            'search' => 'mc_orders.code'
        ],
        'product_name' => [
            'type' => 'text',
            'label' => 'Produk',
            'search' => 'mc_products.name'
        ],
        'customer_name' => [
            'type' => 'text',
            'label' => 'Pelanggan',
            'search' => 'mc_customers.name'
        ],
        'target_id' => [
            'type' => 'options-obj:users,id,name',
            'label' => 'Asal',
        ],
        'table_name' => [
            'type' => 'text',
            'label' => 'No. Meja'
        ],
        'floor_name' => [
            'type' => 'text',
            'label' => 'Lantai'
        ],
        'qty' => [
            'label' => 'Jumlah',
            'type' => 'number'
        ],
        'status' => [
            'type' => 'text',
            'label' => 'Status'
        ],
        '_userstamp' => true
    ]
];