<?php

namespace App\Http\Controllers;

use App\Models\{Order, Discount, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Calculate delivery date based on pincode.
     * 
     * @param string $pincode
     * @return \Carbon\Carbon
     */
    protected function calculateDeliveryDate($pincode)
    {
        // Define a basic mapping of pincode to delivery days
        $deliveryDays = [
            '110001' => 3,  // Example: Delhi, delivery in 3 days
            '400001' => 5,  // Example: Mumbai, delivery in 5 days
            '600001' => 4,  // Example: Chennai, delivery in 4 days
            // Add more pin codes as required
        ];

        // Set a default delivery time if the pincode is not mapped
        $daysToAdd = $deliveryDays[$pincode] ?? 7; // Default 7 days

        return Carbon::now()->addDays($daysToAdd); // Returns the delivery date
    }

    /**
     * Display a listing of all orders.
     */
    public function index()
    {
        // Paginate the orders, for example, 10 orders per page
        $orders = Order::paginate(10);

        // Pass the paginated orders to the view
        return view('Staff.pages.order.index', compact('orders'));
    }


    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $products = Product::all();
        return view('Staff.pages.order.create', compact("products"));
    }

    /**
     * Store a newly created order in storage.
     */

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'total_amount' => ['required', 'numeric', 'min:0'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'final_amount' => ['required', 'numeric', 'min:0'],
            'order_items' => ['required', 'array', 'min:1'],
            'order_items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'order_items.*.quantity' => ['required', 'integer', 'min:1'],
            'order_items.*.discount_code' => ['nullable', 'string', 'max:50'],
            'billing.name' => ['required', 'string', 'max:255'],
            'billing.address' => ['required', 'string', 'max:255'],
            'billing.country' => ['required', 'string', 'max:100'],
            'billing.city' => ['required', 'string', 'max:100'],
            'billing.zip_code' => ['required', 'string', 'max:20'],
            'billing.contact_number' => ['required', 'string', 'max:20'],
            'billing.email' => ['required', 'email', 'max:255'],
            'shipping.name' => ['required_if:shipping_different,true', 'string', 'max:255'],
            'shipping.address' => ['required_if:shipping_different,true', 'string', 'max:255'],
            'shipping.country' => ['required_if:shipping_different,true', 'string', 'max:100'],
            'shipping.city' => ['required_if:shipping_different,true', 'string', 'max:100'],
            'shipping.zip_code' => ['required_if:shipping_different,true', 'string', 'max:20'],
            'shipping.contact_number' => ['required_if:shipping_different,true', 'string', 'max:20'],
            'payment_type' => ['required', 'in:cod,online'],
        ]);

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

        // Update the order with the tracking number
        $order->update([
            'tracking_number' => $trackingNumber,
        ]);

        // Combine country code and contact number for both billing and shipping (if required)
        $validatedData['billing']['phone'] = $validatedData['billing']['contact_number'];
        if (isset($validatedData['shipping']['contact_number'])) {
            $validatedData['shipping']['phone'] = $validatedData['shipping']['contact_number'];
        }

        // Assign billing email to shipping email (if necessary)
        if (empty($validatedData['shipping']['email'])) {
            $validatedData['shipping']['email'] = $validatedData['billing']['email'];
        }

        // Insert billing and shipping data
        $order->billing()->create($validatedData['billing']);
        if (isset($validatedData['shipping']['name'])) {
            $order->shipping()->create($validatedData['shipping']);
        }

        // Insert order items
        $order->orderItems()->createMany($validatedData['order_items']);

        // Flash message to session and redirect
        return redirect()->back()->with('success', 'Order created successfully! Tracking Number: ' . $trackingNumber);
    }




    /**
     * Show the form for editing an order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('Staff.pages.order.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,canceled',
            'delivery_status' => 'required|in:pending,shipped,delivered,returned,canceled',
            'payment_status' => 'required|in:pending,paid,refunded,failed',
            'total_amount' => 'required|numeric',
            'discount_code' => 'nullable|string',
            'discount_amount' => 'nullable|numeric',
            'final_amount' => 'required|numeric',
            'tracking_number' => 'nullable|string',
            'delivery_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'pincode' => 'required|string', // Validate pincode
        ]);

        // Calculate delivery date based on pincode
        $validated['delivery_date'] = $this->calculateDeliveryDate($validated['pincode']);

        // If discount code is provided, validate and calculate discount
        if ($validated['discount_code']) {
            $discount = Discount::where('code', $validated['discount_code'])->first();
            if ($discount) {
                $validated['discount_amount'] = $discount->value;
            } else {
                return back()->withErrors(['discount_code' => 'Invalid discount code.']);
            }
        }

        // Calculate final amount after discount
        $validated['final_amount'] = $validated['total_amount'] - ($validated['discount_amount'] ?? 0);

        // Find the order and update it
        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
    public function getProductDiscount($productId)
    {
        $product = Product::with('discounts')->findOrFail($productId);
        $discounts = $product->discounts; // Assuming `discounts` is the relationship with the discount model
        return response()->json($discounts);
    }

    /**
     * Display order statistics (Optional for analytics).
     */
    public function stats()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'canceled_orders' => Order::where('status', 'canceled')->count(),
            'delivered_orders' => Order::where('delivery_status', 'delivered')->count(),
        ];

        return view('Staff.pages.order.stats', compact('stats'));
    }
}
