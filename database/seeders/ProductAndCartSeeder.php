<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductAndCartSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('carts')->delete();
        DB::table('products')->delete();
        DB::table('users')->delete();

        // Insert users
        $users = [
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);

        // Insert products
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'category_id' => 1,
                'price' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'category_id' => 1,
                'price' => 39.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description for Product 3',
                'category_id' => 1,
                'price' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);

        // Retrieve IDs for users and products
        $user1Id = DB::table('users')->where('email', 'user1@example.com')->first()->id;
        $user2Id = DB::table('users')->where('email', 'user2@example.com')->first()->id;
        $product1Id = DB::table('products')->where('name', 'Product 1')->first()->id;
        $product2Id = DB::table('products')->where('name', 'Product 2')->first()->id;
        $product3Id = DB::table('products')->where('name', 'Product 3')->first()->id;

        // Insert cart items
        $carts = [
            [
                'user_id' => $user1Id,
                'product_id' => $product1Id,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user1Id,
                'product_id' => $product2Id,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user2Id,
                'product_id' => $product3Id,
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('carts')->insert($carts);
    }
}
