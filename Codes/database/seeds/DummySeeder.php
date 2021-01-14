<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(TicketSeeder::class);
    }
}