<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Call each seeder class here
        $this->call([
            CategoriesTableSeeder::class,
            ProductAndCartSeeder::class,
            CustomerSeeder::class,
            AboutSeeder::class,
            RolesAndPermissionsSeeder::class
        ]);
    }
}
