<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'Customer 1',
                'image_url' => 'https://via.placeholder.com/300',
                'testimonial' => 'Great service and products!',
            ],
            [
                'name' => 'Customer 2',
                'image_url' => 'https://via.placeholder.com/300',
                'testimonial' => 'I love shopping here!',
            ],
            [
                'name' => 'Customer 3',
                'image_url' => 'https://via.placeholder.com/300',
                'testimonial' => 'Exceptional quality and value!',
            ],
        ]);
    }
}
