<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Ticket::class, function (Faker $faker) {
    return [
        'user_id'           => \App\User::all()->random()->id,
        'slug' 				=> $faker->slug,
        'department_id'     => \App\Department::all()->random()->id,
        'subject' 			=> $faker->sentence(15),
        'description' 		=> $faker->paragraph(150),
        'priority'          => $faker->randomElements(['normal', 'low', 'high', 'emergency'])[0],
        'ticket_show_by' 	=> $faker->randomElements(['public', 'private'])[0],
    ];
});
