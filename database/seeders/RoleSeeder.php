<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $role_staff = Role::create(['name' => 'staff']);


        $role_staff->givePermissionTo(
        	[
        		'is_staff',
                'crud_administrators',
                'crud_ranks',
                'crud_servers',
                'crud_bans',
                'crud_players',
                'crud_packages',
                'crud_orders',
                'crud_system_parameters',
                'activity_logs',
        	]
        );

        $role_user = Role::create(['name' => 'user']);

        $role_user->givePermissionTo(
        	[
        		'is_user',
        	]
        );
        
    }
}
