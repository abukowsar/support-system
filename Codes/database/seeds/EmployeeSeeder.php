<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many employees you need, defaulting to 10
        $count =10;

        $this->command->info("Creating {$count} employees.");

        // Create the Employee
        $users = factory(App\Employee::class, $count)->create()->each(function($user) {
            $user->profile()->save(factory('App\EmployeeProfile')->make());
            $user->assignRole('employee');
        });


        $this->command->info('Employees Created!');
    }
}
