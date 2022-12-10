<?php

use App\Models\Blog;
use App\Models\User;

return [
    'models' => [
        'user' => [
            'table' => 'users',
            'class' => User::class
        ],

        'blog' => [
            'table' => 'blogs',
            'class' => Blog::class
        ]
    ]
];