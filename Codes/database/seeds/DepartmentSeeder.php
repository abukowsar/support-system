<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
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

        $this->command->info("Creating {$count} department.");

        // Create the Departments
        $users = factory(App\Department::class, $count)->create();

        $this->command->info('Department Created!');
    }
}
