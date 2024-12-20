<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use App\Models\Order;

class ShippingAddressController extends Controller
{
    /**
     * Show the form for creating a new shipping address for the given order.
     */
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.shipping_addresses.create', compact('order'));
    }

    /**
     * Store a newly created shipping address in storage.
     */
    public function store(Request $request, $orderId)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
        ]);

        $order = Order::findOrFail($orderId);
        $order->shippingAddress()->create($validated);

        return redirect()->route('orders.show', $orderId)->with('success', 'Shipping address added!');
    }

    /**
     * Update the specified shipping address in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
        ]);

        $shippingAddress = ShippingAddress::findOrFail($id);
        $shippingAddress->update($validated);

        return redirect()->route('orders.show', $shippingAddress->order_id)->with('success', 'Shipping address updated!');
    }
}
