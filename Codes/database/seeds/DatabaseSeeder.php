<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AppSettingsTableSeeder::class);
        $this->call(StaticDataTableSeeder::class);
        $this->call(GoldenmaceSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(MailTemplatesTableSeeder::class);
        $this->call(MailMailablesTableSeeder::class);
        $this->call(MailTemplateMailableMappingsTableSeeder::class);
    }
}
