<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Add a product to the wishlist
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Check if the product is already in the wishlist
        $existingWishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingWishlistItem) {
            return redirect()->back()->with('message', 'Product already in wishlist');
        }

        // Add product to the wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('message', 'Product added to wishlist');
    }

    // Show the user's wishlist
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('Client.pages.wishlist.index', compact('wishlists'));
    }

    // Remove a product from the wishlist
    public function remove($productId)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('message', 'Product removed from wishlist');
        }

        return redirect()->back()->with('error', 'Product not found in wishlist');
    }
}
