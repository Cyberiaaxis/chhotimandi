<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class DiscountController extends Controller
{
    /**
     * Display a listing of the discounts.
     */
    public function index()
    {
        $discounts = Discount::with(['category', 'product'])->paginate(10); // Adjust the number per page as needed
        // dd($discounts);
        return view('Staff.pages.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new discount.
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('Staff.pages.discount.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created discount in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'code' => 'required|string|unique:discounts,code',
            'type' => 'required|in:percentage,flat',
            'value' => 'required|numeric|min:0.01',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'min_amount' => 'nullable|numeric|min:0',
            'product_id' => 'required|exists:products,id', // Ensure the product exists
            'is_active' => 'required|boolean',
        ]);

        // dd( $validated['min_amount'] ?? null,);
        // Create a new discount record
        Discount::create([
            'code' => $validated['code'],
            'type' => $validated['type'],
            'value' => $validated['value'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'min_amount' => $validated['min_amount'] ?? null,
            'product_id' => $validated['product_id'],
            'is_active' => $validated['is_active'],
        ]);

        // Redirect back to the discounts index with a success message
        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully!');
    }



    public function edit($id)
    {
        // Retrieve the discount to be edited
        $discount = Discount::findOrFail($id);
        $products = Product::all();  // Assuming you want to list all products
        return view('Staff.pages.discount.edit', compact('discount', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'code' => 'required|string|unique:discounts,code,' . $id,  // Ensure the discount code is unique but ignore the current record
            'type' => 'required|in:percentage,flat',
            'value' => 'required|numeric|min:0.01',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'min_amount' => 'nullable|numeric|min:0',
            'product_id' => 'required|exists:products,id',
            'is_active' => 'required|boolean',
        ]);
        // dd($validated);
        // Retrieve the discount to be updated
        $discount = Discount::findOrFail($id);

        // Update the discount record
        $discount->update([
            'code' => $validated['code'],
            'type' => $validated['type'],
            'value' => $validated['value'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'min_amount' => $validated['min_amount'],
            'product_id' => $validated['product_id'],
            'is_active' => $validated['is_active'],
        ]);


        // Redirect to the discounts index with a success message
        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully!');
    }

    /**
     * Remove the specified discount from storage.
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully!');
    }
}
