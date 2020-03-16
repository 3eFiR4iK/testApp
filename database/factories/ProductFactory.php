<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$images = [
    'images/products/img1.png',
    'images/products/img2.png',
    'images/products/img3.png',
];

$factory->define(Product::class, function (Faker $faker) use ($images) {
    return array(
        'name' => $faker->title,
        'description' => $faker->text,
        'image' => $images[rand(0, 2)],
        'category_id' => rand(1, 9),
    );
});
