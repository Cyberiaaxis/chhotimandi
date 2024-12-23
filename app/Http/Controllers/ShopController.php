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
        $products = Product::all(); // Fetch initial products or use a default category

        return view("Client.pages.shop.index", compact('categories', 'products'));
    }

    public function getProductsByCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $products = Product::where('category_id', $request->category_id)->get();

        return response()->json(['products' => $products]);
    }
}
