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
        $products = Product::with('discounts')->get(); // Fetch initial products or use a default category

        return view("Client.pages.shop.index", compact('categories', 'products'));
    }

    public function getProductsByCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        // Fetch products and their discounts (if any)
        $products = Product::where('category_id', $request->category_id)
            ->with(['discounts' => function ($query) {
                // Optionally, you can filter the discounts to be active and within the date range
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
        // dd($products);
        // Return the products with the discounts
        return response()->json(['products' => $products]);
    }
}
