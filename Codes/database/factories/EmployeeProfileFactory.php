<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\EmployeeProfile::class, function (Faker $faker) {
    return [
        'gender' 	=> $faker->randomElements(['male', 'female'])[0],
        'address' 	=> $faker->address,
        'dob' 		=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'city' 		=> $faker->city,
        'state' 	=> $faker->state,
        'country' 	=> $faker->country,
        'pincode' 	=> $faker->postcode,
    ];
});
