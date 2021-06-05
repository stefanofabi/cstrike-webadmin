<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user_administrator = new User(
            [
                'name' => 'Admin',
                'email' => 'admin@community',
                'password' => Hash::make('password'),
            ]
        );

        $user_administrator->saveOrFail();
        $user_administrator->assignRole('staff');
    }
}
