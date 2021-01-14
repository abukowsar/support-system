<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many users you need, defaulting to 10
        $count =10;

        $this->command->info("Creating {$count} users.");

        // Create the User
        $users = factory(App\User::class, $count)->create()->each(function($user) {
            $user->userProfile()->save(factory('App\UserProfile')->make());
            $user->assignRole('user');
        });


        $this->command->info('Users Created!');
    }
}
