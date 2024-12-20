<?php

// app/Http/Controllers/BillingAddressController.php
namespace App\Http\Controllers;

use App\Models\BillingAddress;
use Illuminate\Http\Request;
use App\Models\Order;

class BillingAddressController extends Controller
{
    /**
     * Show the form for creating a new billing address for the given order.
     */
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.billing_addresses.create', compact('order'));
    }

    /**
     * Store a newly created billing address in storage.
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
        $order->billingAddress()->create($validated);

        return redirect()->route('orders.show', $orderId)->with('success', 'Billing address added!');
    }

    /**
     * Update the specified billing address in storage.
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

        $billingAddress = BillingAddress::findOrFail($id);
        $billingAddress->update($validated);

        return redirect()->route('orders.show', $billingAddress->order_id)->with('success', 'Billing address updated!');
    }
}
