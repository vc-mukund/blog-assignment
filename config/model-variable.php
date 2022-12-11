<?php

use App\Models\Blog;
use App\Models\User;
use Spatie\Permission\Models\Role;

return [
    'models' => [
        'user' => [
            'table' => 'users',
            'class' => User::class
        ],

        'blog' => [
            'table' => 'blogs',
            'class' => Blog::class
        ],

        'role' => [
            'table' => 'roles',
            'class' => Role::class
        ]
    ]
];