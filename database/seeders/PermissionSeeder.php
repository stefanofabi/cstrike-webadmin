<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'is_staff']);
    	Permission::create(['name' => 'crud_administrators']);
    	Permission::create(['name' => 'crud_ranks']);
    	Permission::create(['name' => 'crud_servers']);
        Permission::create(['name' => 'crud_bans']);
        Permission::create(['name' => 'crud_players']);

        Permission::create(['name' => 'is_user']);
    }
}
