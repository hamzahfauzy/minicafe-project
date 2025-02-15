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
    ],
    'mc_sections' => [
        'organization_id' => [
            'type' => 'options-obj:saas_organizations,id,name',
            'label' => 'Organisasi'
        ],
        'name' => [
            'type' => 'text',
            'label' => 'Nama'
        ]
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
        ]
    ]
];