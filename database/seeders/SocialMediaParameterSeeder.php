<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemParameter;

class SocialMediaParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemParameter::insert([
            [
                'name' => 'WhatsApp',
                'key' => 'WHATSAPP',
                'value' => 'https://wa.me/mynumber',
                'category' => 'Social Media',
                'description' => 'WhatsApp contact number'
            ], [
                'name' => 'Instagram',
                'key' => 'INSTAGRAM',
                'value' => 'https://instagram.com/myCommunity',
                'category' => 'Social Media',
                'description' => 'Instagram username'
            ], [
                'name' => 'Facebook',
                'key' => 'FACEBOOK',
                'value' => 'https://facebook.com/myCommunity',
                'category' => 'Social Media',
                'description' => 'URL of the Facebook page'
            ], [
                'name' => 'YouTube',
                'key' => 'YOUTUBE',
                'value' => 'https://youtube.com/channel/myCommunity',
                'category' => 'Social Media',
                'description' => 'URL of the YouTube channel'
            ],
            [
                'name' => 'TikTok',
                'key' => 'TIKTOK',
                'value' => 'https://tiktok.com/myCommunity',
                'category' => 'Social Media',
                'description' => 'TikTok username'
            ],
        ]);
    }
}
