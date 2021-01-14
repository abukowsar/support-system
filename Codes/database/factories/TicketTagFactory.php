<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\TicketTags::class, function (Faker $faker) {
    return [
        'category_id' => \App\Categories::all()->random()->id
    ];
});
