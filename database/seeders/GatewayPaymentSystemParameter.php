<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\SystemParameter;

class GatewayPaymentSystemParameter extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        SystemParameter::insert([
            [
                'name' => 'Bank',
                'key' => 'BANK',  
                'value' => 'My Bank', 
                'category' => 'Gateway Payment', 
                'description' => 'The name of your bank'
            ], [
                'name' => 'Account owner',
                'key' => 'ACCOUNT_OWNER',  
                'value' => 'My Name', 
                'category' => 'Gateway Payment', 
                'description' => 'The name of owner account'
            ], [
                'name' => 'Owner identification',
                'key' => 'OWNER_IDENTIFICATION',  
                'value' => '123.456.789', 
                'category' => 'Gateway Payment', 
                'description' => ''
            ], [
                'name' => 'Bank Account number',
                'key' => 'BANK_ACCOUNT_NUMBER',  
                'value' => '1234567891011121314151617181920212223', 
                'category' => 'Gateway Payment', 
                'description' => ''
            ], [
                'name' => 'Bank account alias',
                'key' => 'BANK_ACCOUNT_ALIAS',  
                'value' => 'myname.bank', 
                'category' => 'Gateway Payment', 
                'description' => ''
            ],
            
        ]);
    }
}
