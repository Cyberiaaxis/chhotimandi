<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function categories()
    {
        $categories = Category::all();

        // Retrieve products with their active discounts
        $products = Product::with(['discounts' => function ($query) {
            $query->where('is_active', true)
                ->where(function ($query) {
                    $query->whereNull('start_date')
                        ->orWhere('start_date', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('end_date')
                        ->orWhere('end_date', '>=', now());
                });
        }])->get();

        // Loop through each product and apply discount logic
        $products = $products->map(function ($product) {
            $activeDiscount = $product->discounts;

            if ($activeDiscount !== null) {
                if ($activeDiscount->type === 'percentage') {
                    $product->sale_price = $product->price - ($product->price * ($activeDiscount->value / 100));
                } else {
                    $product->sale_price = $product->price - $activeDiscount->value;
                }
            } else {
                $product->sale_price = $product->price;
            }

            return $product;
        });

        // Check if the user is logged in
        $isLoggedIn = auth()->check();
        // dd($isLoggedIn);
        // Pass the categories, products, and login status to the view
        return view("Client.pages.shop.index", compact('categories', 'products', 'isLoggedIn'));
    }

    public function getProductsByCategory(Request $request)
    {
        // Validate the category_id from the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        // Fetch products for the selected category with their active discounts
        $products = Product::where('category_id', $request->category_id)
            ->with(['discounts' => function ($query) {
                $query->where('is_active', true)
                    ->where(function ($query) {
                        $query->whereNull('start_date')
                            ->orWhere('start_date', '<=', now());
                    })
                    ->where(function ($query) {
                        $query->whereNull('end_date')
                            ->orWhere('end_date', '>=', now());
                    });
            }])
            ->get();

        // Loop through each product to apply discount logic
        $products = $products->map(function ($product) {
            $activeDiscount = $product->discounts;

            if ($activeDiscount !== null) {
                if ($activeDiscount->type === 'percentage') {
                    $product->sale_price = $product->price - ($product->price * ($activeDiscount->value / 100));
                } else {
                    $product->sale_price = $product->price - $activeDiscount->value;
                }
            } else {
                $product->sale_price = $product->price;
            }

            return $product;
        });

        // Check if the user is logged in
        $isLoggedIn = auth()->check();

        // Return the products and login status as a JSON response
        return response()->json([
            'products' => $products,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }
}
