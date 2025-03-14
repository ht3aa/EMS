<?php

return [
    'created' => 'Order created',
    'sections' => [
        'information' => 'Information',
    ],

    'model' => [
        'cart_id' => 'Cart ID',
        'status' => 'Status',
    ],

    'columns' => [
        'user' => [
            'name' => 'User Name',
        ],
        'product' => [
            'name' => 'Product Name',
            'price' => 'Product Price',
        ],
        'status' => [
            'title' => 'Status',
            'created' => 'Order created',
            'shipped' => 'Order shipped',
            'delivered' => 'Order delivered',
        ],
        'quantity' => 'Quantity',
    ],

    'tabs' => [
        'all' => 'All Orders',
        'created' => 'Created Order',
        'shipped' => 'Shipped Orders',
        'delivered' => 'Delivered Orders',
    ],
    'stats' => [
        'total' => 'Total Orders',
    ],

    'charts' => [
        'orders_per_month' => 'Orders per months',
    ],
];
