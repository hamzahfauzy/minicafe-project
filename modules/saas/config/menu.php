<?php 

return [
    [
        'label' => 'saas.menu.organizations',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-sitemap',
        'route' => routeTo('crud/index',['table' => 'saas_organizations']),
        'activeState' => 'saas.saas_organizations'
    ],
    [
        'label' => 'saas.menu.plans',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-tags',
        'route' => routeTo('crud/index',['table' => 'saas_plans']),
        'activeState' => 'saas.saas_plans'
    ],
    [
        'label' => 'saas.menu.invoices',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-receipt',
        'route' => routeTo('crud/index',['table' => 'saas_invoices']),
        'activeState' => 'saas.saas_invoices'
    ],
    [
        'label' => 'saas.menu.subscriptions',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-heart',
        'route' => routeTo('crud/index',['table' => 'saas_subscriptions']),
        'activeState' => 'saas.saas_subscriptions'
    ],
];