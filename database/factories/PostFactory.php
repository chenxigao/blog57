<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
<<<<<<< HEAD
    $images = ['about-bg.jpg', 'content-bg.jpg', 'home-bg.jpg', 'post-bg.jpg'];
    $title = $faker->sentence(mt_rand(3, 10));

    return [
            'title'            => $title,
            'subtitle'         => str_limit($faker->sentence(mt_rand(10, 20)), 252),
            'page_image'       => $images[mt_rand(0, 3)],
            'content_raw'      => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
            'published_at'     => $faker->dateTimeBetween('-1 month', '+3 days'),
            'meta_description' => 'Meta for $title',
            'is_draft'         => false,
=======
    $images = ['about-bg.jpg', 'contact-bg.jpg', 'home-bg.jpg', 'post-bg.jpg'];
    $title = $faker->sentence(mt_rand(3, 10));
    return [
        'title' => $title,
        'subtitle' => str_limit($faker->sentence(mt_rand(10, 20)), 252),
        'page_image' => $images[mt_rand(0, 3)],
        'content_raw' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
        'meta_description' => "Meta for $title",
        'is_draft' => false,
>>>>>>> 6d7100076c30641084502503ada7fd82fb873d55
    ];
});
