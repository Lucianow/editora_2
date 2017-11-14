<?php

return [
    'email' => [
        'user_created' => [
            'subject' => config('app.name') . ' - Sua conta foi criada'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified'
    ],
    'user_default' => [
        'name' => env('USER_NAME', 'Administrator'),
        'email' => env('USER_EMAIL', 'admin@email.com'),
        'password' => env('USER_PASSWORD', 'secret')
    ]
];
