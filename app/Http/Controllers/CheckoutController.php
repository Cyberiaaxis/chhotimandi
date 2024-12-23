<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch cart details (for example, from session or database)
        $cartItems = session()->get('cart', []);

        return view('Client.pages.checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {
        // Validation rules
        $rules = [
            'total_amount' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'final_amount' => 'required|numeric|min:0',
            'order_items' => 'required|array|min:1',
            'order_items.*.product_id' => 'required|integer|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.discount_code' => 'nullable|string|max:50',

            'billing.name' => 'required|string|max:255',
            'billing.address' => 'required|string|max:255',
            'billing.country' => 'required|string|max:100',
            'billing.city' => 'required|string|max:100',
            'billing.zip_code' => 'required|string|max:20',
            'billing.country_code' => 'required|string|max:5',
            'billing.contact_number' => 'required|string|max:20',
            'billing.email' => 'required|email|max:255',

            'shipping.name' => 'required|string|max:255',
            'shipping.address' => 'required|string|max:255',
            'shipping.country' => 'required|string|max:100',
            'shipping.city' => 'required|string|max:100',
            'shipping.zip_code' => 'required|string|max:20',
            'shipping.country_code' => 'required|string|max:5',
            'shipping.contact_number' => 'required|string|max:20',

            'payment_type' => 'required|in:cod,online',
        ];

        // Custom error messages
        $messages = [
            'order_items.*.product_id.exists' => 'One or more products are invalid.',
            'billing.email.email' => 'Please provide a valid email address.',
        ];

        // Validate the request
        $validatedData = $request->validate($rules, $messages);

        // Combine country code and contact number for billing and shipping
        $validatedData['billing']['phone'] = $validatedData['billing']['country_code'] . '-' . $validatedData['billing']['contact_number'];
        $validatedData['shipping']['phone'] = $validatedData['shipping']['country_code'] . '-' . $validatedData['shipping']['contact_number'];

        // Assign billing email to shipping email
        $validatedData['shipping']['email'] = $validatedData['billing']['email'];

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_date' => now(),
            'total_amount' => $validatedData['total_amount'],
            'discount_amount' => $validatedData['discount_amount'] ?? 0,
            'final_amount' => $validatedData['final_amount'],
            'payment_type' => $validatedData['payment_type'],
        ]);

        // Generate a unique tracking number
        $trackingNumber = strtoupper(uniqid($order->id . '-', true));
        $order->update([
            'tracking_number' => $trackingNumber,
        ]);

        // Save billing and shipping details
        $order->billing()->create($validatedData['billing']);
        $order->shipping()->create($validatedData['shipping']);

        // Save order items
        $order->orderItems()->createMany($validatedData['order_items']);

        // Return a response or redirect
        return redirect()->route('checkout.index')->with('success', 'Your order has been placed successfully!');
    }
}
