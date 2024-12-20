<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    public function run()
    {
        About::create([
            'mission' => 'To provide excellent service and products to our customers.',
            'team_members' => json_encode([
                ['name' => 'John Doe', 'position' => 'CEO', 'bio' => 'John is the visionary behind our company.', 'image' => 'https://via.placeholder.com/300'],
                ['name' => 'Jane Smith', 'position' => 'CTO', 'bio' => 'Jane leads our technology strategy.', 'image' => 'https://via.placeholder.com/300']
            ]),
        ]);
    }
}
