<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'sales' => 'c,r,u,d',
            'purchases' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'providers' => 'c,r,u,d',
            'spendings' => 'c,r,u,d',
        ],
        'employer' => []
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];