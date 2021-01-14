<?php

use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = \Config::get('constant.ROLES');

        foreach ($roles as $role => $guardName) {
            \DB::table('roles')->insert([
                [
                    'name'          => $role,
                    'guard_name'    => $guardName
                ],
            ]);
        }

        $permissions = \Config::get('constant.PERMISSIONS');

        foreach ($permissions as $permission => $guardName) {
            \DB::table('permissions')->insert([
                [
                    'name'          => $permission,
                    'guard_name'    => $guardName
                ],
            ]);
        }
    }
}
