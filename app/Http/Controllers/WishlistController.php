<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    // Show the user's wishlist
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('Client.pages.wishlist.index', compact('wishlists'));
    }

    public function addToWish(Product $product, Wishlist $wishlist): JsonResponse
    {
        $wishlistItem = $wishlist->updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]
        );

        $message = $wishlistItem->wasRecentlyCreated
            ? 'Product added to wishlist successfully'
            : 'Product is already in your wishlist';

        return response()->json(['message' => $message], $wishlistItem->wasRecentlyCreated ? 201 : 200);
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
