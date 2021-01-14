<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
        'name' 				=> $faker->name,
        'department_id'     => \App\Department::all()->where('default',0)->random()->id,
        'email' 			=> $faker->unique()->safeEmail,
        'password' 			=> bcrypt('goldenmace'), // password
        'remember_token' 	=> Str::random(10),
    ];
});
