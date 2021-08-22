<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Rank::insert([
            [
                'name' => 'Staff',
                'access_flags' => 'abcdefhijkmnopqrstuv',
                'price' => 3,
                'color' => '#FF0000',

            ],
            [
                'name' => 'Full Admin',
                'access_flags' => 'bcdefhijkmnopqrstuv',
                'price' => 2,
                'color' => '#0CFF00',

            ],
            [
                'name' => 'Basic Admin',
                'access_flags' => 'cefhijkmnopqrstuv',
                'price' => 1,
                'color' => '#FFA200',
            ],
        ]);
    }
}
