<?php 

return [
    'saas_organizations' =>  [
        'owner_id' => [
            'label' => 'Owner',
            'type' => 'options-obj:users,id,name'
        ],
        'name',
        'address',
        'phone'
    ],
    'saas_plans' => [
        'name',
        'description',
        'monthly_price',
        'annualy_price'
    ],
    'saas_invoices' => [
        'organization_id' => [
            'label' => 'Organization',
            'type' => 'options-obj:saas_organizations,id,name'
        ],
        'plan_id' => [
            'label' => 'Plan',
            'type' => 'options-obj:saas_plans,id,name'
        ],
        'code',
        'total_price',
        'qty',
        'unit',
        'status',
        'payment_at'
    ],
    'saas_subscriptions' => [
        'organization_id' => [
            'label' => 'Organization',
            'type' => 'options-obj:saas_organizations,id,name'
        ],
        'plan_id' => [
            'label' => 'Plan',
            'type' => 'options-obj:saas_plans,id,name'
        ],
        'start_at' => [
            'label' => 'Start At',
            'type' => 'datetime-local'
        ],
        'expired_at' => [
            'label' => 'Expired At',
            'type' => 'datetime-local'
        ],
        'status'  => [
            'label' => 'Status',
            'type' => 'options:ACTIVE|EXPIRED'
        ]
    ]
];