<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    // Display a list of chefs
    public function index()
    {
        $chefs = Chef::all();
        return view('Staff.pages.chef.index', compact('chefs'));
    }

    // Show the form for creating a new chef
    public function create()
    {
        return view('Staff.pages.chef.create');
    }

    // Store a newly created chef
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $chef = new Chef();
        $chef->name = $request->name;
        $chef->specialty = $request->specialty;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chefs', 'public');
            $chef->image = $path;
        }

        $chef->save();
        return redirect()->route('admin.chefs.index')->with('success', 'Chef created successfully!');
    }

    // Show the form for editing a chef
    public function edit($id)
    {
        $chef = Chef::findOrFail($id);
        return view('Staff.pages.chef.edit', compact('chef'));
    }

    // Update the specified chef
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $chef = Chef::findOrFail($id);
        $chef->name = $request->name;
        $chef->specialty = $request->specialty;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($chef->image) {
                Storage::delete('public/' . $chef->image);
            }

            // Store new image
            $path = $request->file('image')->store('chefs', 'public');
            $chef->image = $path;
        }

        $chef->save();
        return redirect()->route('admin.chefs.index')->with('success', 'Chef updated successfully!');
    }

    // Delete a chef
    public function destroy($id)
    {
        $chef = Chef::findOrFail($id);

        // Delete image if exists
        if ($chef->image) {
            Storage::delete('public/' . $chef->image);
        }

        $chef->delete();
        return redirect()->route('admin.chefs.index')->with('success', 'Chef deleted successfully!');
    }
}
