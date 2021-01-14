<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GoldenmaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$adminUser = \App\Admin::create([
            'name' 		=> 'Admin',
            'email' 	=> 'admin@demo.com',
            'password'  => bcrypt('12345678'),
        ]);

        $adminUser->assignRole('admin');

        $categories=\Config::get('constant.CATEGORIES');
        foreach ($categories as $category_slug=> $category) {
            \App\Categories::insert([
                'slug'          => $category_slug,
                'category_name' => $category
            ]);
        }

        $departments = \Config::get('constant.DEPARTMENTS');

        foreach ($departments as $key => $department) {
            \DB::table('departments')->insert([
                [
                    'department_name' => $department['name'],
                    'default' => $department['default'],
                    'is_hidden' => $department['is_hidden'],
                ],
            ]);
        }

        $user = \App\User::create([
            'name'      => 'User',
            'email'     => 'user@demo.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('12345678'),
        ]);

        $user->userProfile()->save(factory('App\UserProfile')->make());
        $user->assignRole('user');

        $employee = \App\Employee::create([
            'name'          => 'Employee',
            'department_id' => 1,
            'email'         => 'employee@demo.com',
            'password'      => bcrypt('12345678'),
        ]);

        $employee->profile()->save(factory('App\EmployeeProfile')->make());
        $employee->assignRole('employee');


        $leader = \App\Employee::create([
            'name'          => 'Leader',
            'department_id' => 1,
            'email'         => 'leader@demo.com',
            'password'      => bcrypt('12345678'),
        ]);

        $leader->profile()->save(factory('App\EmployeeProfile')->make());
        $leader->assignRole('employee');
        $leader->assignRole('leader');

        \App\DepartmentLeader::create([
            'department_id'     => 1,
            'leader_id'         => $leader->id
        ]);

    }
}
