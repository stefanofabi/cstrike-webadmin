<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\SystemParameter;

class GeneralParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        SystemParameter::insert([
            [
                'name' => 'Community name',
                'key' => 'COMMUNITY_NAME',  
                'value' => 'My Community', 
                'category' => 'General', 
                'description' => 'The name of your community'
            ], [
                'name' => 'Sales Email',
                'key' => 'SALES_EMAIL',  
                'value' => 'sales@community', 
                'category' => 'General', 
                'description' => 'The sales email to contact'
            ], [
                'name' => 'Date format',
                'key' => 'DATE_FORMAT',  
                'value' => 'Y-m-d', 
                'category' => 'General', 
                'description' => 'This will be the format in which the dates will be displayed both within the system'
            ], 
            
        ]);
    }
}