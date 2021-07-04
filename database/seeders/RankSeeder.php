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
                'name' => 'Full Admin with immunity',
                'access_flags' => 'abcdefhijkmnopqrstu',
                'price' => 3

            ],
            [
                'name' => 'Basic Admin with out reserved slot',
                'access_flags' => 'cdefhijkmnopqrstu',
                'price' => 1

            ],
        ]);
    }
}
