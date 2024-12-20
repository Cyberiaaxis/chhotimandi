<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     * 
     * This method retrieves all the categories from the database and passes them to the view.
     * It is typically used to show a list of categories in an admin interface.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all categories from the database
        $categories = Category::all();

        // Return the view with the categories data
        return view('Staff.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * 
     * This method returns a view where an administrator can enter the details of a new category.
     * It is used when the admin wants to add a new category to the system.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the view to create a category
        return view('Staff.pages.category.create');
    }

    /**
     * Store a newly created category in the database.
     * 
     * This method validates the incoming request data and then stores the new category in the database.
     * It ensures that the category name is unique and not empty. After storing, it redirects to the categories list with a success message.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);

        // Create and store the category in the database
        Category::create([
            'category_name' => $validated['category_name'],
        ]);

        // Redirect back to the categories list with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category.
     * 
     * This method retrieves a specific category by its ID from the database and returns a view displaying its details.
     * If the category is not found, it will throw a 404 error.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find the category by its ID, or throw a 404 error if not found
        $category = Category::findOrFail($id);

        // Return the view with the category data
        return view('Staff.pages.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     * 
     * This method retrieves a specific category by its ID and passes it to the view, where the user can edit its details.
     * It is used to update an existing category in the system.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find the category by its ID
        $category = Category::find($id);

        // Return the view with the category data for editing
        return view('Staff.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified category in the database.
     * 
     * This method validates the updated data, ensures the category name remains unique, and saves the changes.
     * After updating, it redirects back to the categories list with a success message.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the category by its ID or throw a 404 error if not found
        $category = Category::findOrFail($id);

        // Validate the updated request data
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->id . ',id',
        ]);

        // Update the category's name and save the changes to the database
        $category->category_name = $request->category_name;
        $category->save();

        // Redirect back to the categories list with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified category from the database.
     * 
     * This method deletes the specified category from the database and then redirects back to the categories list
     * with a success message. It is used to remove categories that are no longer needed.
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Delete the category from the database
        $category->delete();

        // Redirect back to the categories list with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
