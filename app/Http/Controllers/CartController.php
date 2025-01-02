<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Product};
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * CartController handles the operations related to cart actions like adding,
 * removing, updating, and viewing cart items.
 */
class CartController extends Controller
{
    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Product $product, Cart $cart): JsonResponse
    {
        $cart->updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,  // Use the injected product instance
            ],
            [
                'quantity' => DB::raw('quantity + ' . 1), // Increment quantity
            ]
        );
        // Return the updated or created cart item as a JSON response
        return response()->json(['message' => 'Product added to cart successfully!']);
    }


    /**
     * Remove an item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCart(int $id): JsonResponse
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

    /**
     * Update the quantity of a cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json($cartItem);
    }

    /**
     * View the items in the user's cart.
     *
     * @return \Illuminate\View\View
     */
    public function viewCart(): View
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        // dd($cartItems);
        return view('Client.pages.cart.index', compact('cartItems'));
    }
}
