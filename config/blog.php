<?php
return [
        'name'             => '晨曦入诗源',
        'title'            => '晨曦',
        'subtitle'         => 'http://www.rui85.cn',
        'meta_description' => '晨曦入诗，暮雨出画！学习使我快乐！',
        'author'           => '晨曦',
        'page_image'       => 'sunny-boy.jpg',
        'posts_per_page'   => 5,
        'uploads'          => [
                'storage' => 'public',
                'webpath' => '/storage',
        ],
        'form'             => [
                'address' => env('MAIL_FROM_ADDRESS', 'springlight@126.com'),
                'name'    => env('MAIL_FROM_NAME', '晨曦入诗源'),
        ],
        'email'            => env('MAIL_FROM'),
];
