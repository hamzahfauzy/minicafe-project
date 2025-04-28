<?php

return [
    [
        'label' => 'minicafe.menu.master',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-box',
        'activeState' => [
            'minicafe.mc_cafes',
            'minicafe.mc_customers',
            'minicafe.operators',
            'minicafe.waiters',
            'minicafe.kitchens',
            'minicafe.cashiers',
            'minicafe.mc_categories',
            'minicafe.mc_sections',
            'minicafe.mc_products'
        ],
        'items' => [
            [
                'label' => 'minicafe.menu.cafes',
                'route' => routeTo('crud/index', ['table' => 'mc_cafes']),
                'activeState' => 'minicafe.mc_cafes'
            ],
            [
                'label' => 'minicafe.menu.operators',
                'route' => routeTo('minicafe/operators/index'),
                'activeState' => 'minicafe.operators'
            ],
            [
                'label' => 'minicafe.menu.cashiers',
                'route' => routeTo('minicafe/cashiers/index'),
                'activeState' => 'minicafe.cashiers'
            ],
            [
                'label' => 'minicafe.menu.waiters',
                'route' => routeTo('minicafe/waiters/index'),
                'activeState' => 'minicafe.waiters'
            ],
            [
                'label' => 'minicafe.menu.kitchens',
                'route' => routeTo('minicafe/kitchens/index'),
                'activeState' => 'minicafe.kitchens'
            ],
            [
                'label' => 'minicafe.menu.customers',
                'route' => routeTo('crud/index', ['table' => 'mc_customers']),
                'activeState' => 'minicafe.mc_customers'
            ],
            [
                'label' => 'minicafe.menu.sections',
                'route' => routeTo('crud/index', ['table' => 'mc_sections']),
                'activeState' => 'minicafe.mc_sections'
            ],
            [
                'label' => 'minicafe.menu.categories',
                'route' => routeTo('crud/index', ['table' => 'mc_categories']),
                'activeState' => 'minicafe.mc_categories'
            ],
            [
                'label' => 'minicafe.menu.products',
                'route' => routeTo('crud/index', ['table' => 'mc_products']),
                'activeState' => 'minicafe.mc_products'
            ],
        ]
    ],
    [
        'label' => 'minicafe.menu.orders',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-shopping-cart',
        'activeState' => [
            'minicafe.mc_orders',
            'minicafe.orders.create',
            'minicafe.new_orders',
            'minicafe.finish_orders',
        ],
        'items' => [
            [
                'label' => 'minicafe.menu.create_orders',
                'route' => routeTo('minicafe/orders/create'),
                'activeState' => 'minicafe.orders.create'
            ],
            [
                'label' => 'minicafe.menu.all_orders',
                'route' => routeTo('crud/index', ['table' => 'mc_orders']),
                'activeState' => 'minicafe.mc_orders'
            ],
            [
                'label' => 'minicafe.menu.new_orders',
                'route' => routeTo('crud/index', ['table' => 'mc_orders', 'filter' => ['status' => 'NEW']]),
                'activeState' => 'minicafe.new_orders'
            ],
            [
                'label' => 'minicafe.menu.finish_orders',
                'route' => routeTo('crud/index', ['table' => 'mc_orders', 'filter' => ['status' => 'FINISH']]),
                'activeState' => 'minicafe.finish_orders'
            ],
        ]
    ],
    [
        'label' => 'minicafe.menu.payments',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cash-register',
        'route' => routeTo('crud/index', ['table' => 'mc_payments']),
        'activeState' => [
            'minicafe.mc_payments',
        ],
    ],
    [
        'label' => 'minicafe.menu.queues',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
        'route' => routeTo('crud/index', ['table' => 'mc_order_items']),
        'activeState' => [
            'minicafe.mc_order_items',
        ],
    ],
    [
        'label' => 'minicafe.menu.reports',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-file',
        'activeState' => [
            'minicafe.reports.recap',
        ],
        'items' => [
            [
                'label' => 'minicafe.menu.recap',
                'route' => routeTo('minicafe/reports/recap'),
                'activeState' => 'minicafe.reports.recap'
            ],
        ]
    ],
];
