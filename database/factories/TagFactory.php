<?php

use Faker\Generator as Faker;
use App\Models\Tag;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    $images = ['about-bg.jpg', 'content-bg.jpg', 'home-bg.jpg', 'post-bg.jpg'];
    $word = $faker->word;
    return [
        'tag' => $word,
        'title' => ucfirst($word),
        'subtitle' => $faker->sentence,
        'page_image' => $images[mt_rand(0, 3)],
        'meta_description' => 'Meta for $word',
        'reverse_direction' => false,
    ];
});
