<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Knowledge::class, function (Faker $faker) {
    return [
        'slug'        => $faker->slug,
        'title'       => $faker->sentence(15),
        'content'     => $faker->paragraph(150),
        'user_id'     => \App\Admin::all()->random()->id,
        'category_id' => \App\Categories::all()->random()->id,
        'views'       => $faker->numberBetween(100, 1000)
    ];
});
