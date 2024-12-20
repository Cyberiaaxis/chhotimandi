<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController
 * 
 * This controller is responsible for managing the products in the system. It provides
 * functionality for displaying, creating, updating, and deleting products.
 * 
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     * 
     * This method retrieves all products along with their associated categories and 
     * passes the data to the view for display.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('Staff.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     * 
     * This method retrieves all categories and passes them to the view for the user 
     * to choose when creating a new product.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('Staff.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created product in the database.
     * 
     * This method validates the form data, handles the file upload for the product image,
     * and saves the product with the necessary attributes (name, description, price, etc.).
     * It also handles saving the quantity of the product.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'qty' => 'required|integer|min:1', // Validate quantity to be an integer and minimum of 1
        ]);

        // Handle the image upload if there is a file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName);
        }

        // Create the new product and save it
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->image = $imageName ?? null;
        $product->category_id = $request->category_id;
        $product->is_active = $request->has('is_active'); // Store the 'active' status
        $product->save();

        // Redirect to the product listing with a success message
        return redirect()->route('admin.products.index')
            ->with('lastInsertedProduct', $product->id)
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     * 
     * This method retrieves the product by its ID and passes it along with all categories
     * to the edit form for the user to update the product details.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('Staff.pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in the database.
     * 
     * This method validates the form data, handles image updates (if a new image is provided),
     * and updates the product details in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qty' => 'required|integer|min:0', // Validate the quantity (can be zero)
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update product attributes
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;
        $product->is_active = $request->has('is_active');

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/images/' . $product->image);
            }

            // Store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName);
            $product->image = $imageName;
        }

        // Save the updated product
        $product->save();

        // Redirect back to the product index with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from the database.
     * 
     * This method deletes the product based on the provided ID and redirects back to the
     * product index with a success message.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product and associated image
        if ($product->image) {
            Storage::delete('public/images/' . $product->image);
        }

        $product->delete();

        // Redirect to the product index with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
