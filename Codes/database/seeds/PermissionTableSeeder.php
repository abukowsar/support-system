<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $admin=Role::where('name', 'admin')->first();

        foreach ($permissions as $key=>$permission){
            $admin->givePermissionTo($permission->name);

            if($permission->name=='ticket'){

                $roles=Role::whereNotIn('name', ['admin'])->get();

                foreach ($roles as $key => $role) {

                    $permission = Permission::findOrCreate($permission->name, $role->guard_name);
                    $role->givePermissionTo($permission->name);
                }
            }
        }
    }
}
