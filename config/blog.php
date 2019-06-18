<?php
return [
        'name'             => 'Spring花园',
        'title'            => 'Spring',
        'subtitle'         => 'blog57.test',
        'meta_description' => 'Spring 致力于提供各种鲜花种植技巧!',
        'author'           => '花仙子',
        'page_image'       => 'home-bg.jpg',
        'posts_per_page'   => 10,
        'uploads'          => [
                'storage' => 'public',
                'webpath' => '/storage',
        ],
        'form'             => [
                'address' => env('MAIL_FROM_ADDRESS', 'springlight@126.com'),
                'name'    => env('MAIL_FROM_NAME', 'Spring花园'),
        ],
];
