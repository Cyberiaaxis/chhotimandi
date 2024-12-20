<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample categories data
        $categories = [
            ['category_name' => 'Electronics'],
            ['category_name' => 'Clothing'],
            ['category_name' => 'Home & Kitchen'],
            ['category_name' => 'Books'],
            ['category_name' => 'Sports & Outdoors'],
            ['category_name' => 'Beauty & Health'],
        ];

        // Insert categories into the database
        DB::table('categories')->insert($categories);
    }
}
