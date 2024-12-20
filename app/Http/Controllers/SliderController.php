<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    // Display all sliders
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('Staff.pages.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('Staff.pages.slider.create');
    }
    // Store a new slider image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/sliders'), $imageName);

        Slider::create([
            'image_path' => 'images/sliders/' . $imageName,
            'title' => $request->title,
            'description' => $request->description,
            'order' => Slider::count() + 1, // Add to the end by default
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider added successfully!');
    }
    public function edit($id)
    {
        // Retrieve the slider by ID
        $slider = Slider::findOrFail($id);

        // Pass the slider data to the view
        return view('Staff.pages.slider.edit', compact('slider'));
    }


    // Update an existing slider image
    public function update(Request $request, $id)
    {
        // Get the slider to update
        $slider = Slider::findOrFail($id);

        // Validate the request, ensuring the order is unique across the sliders
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer|unique:sliders,order,' . $slider->id,  // Ensure the order is unique except for the current slider
        ]);

        // Handle the image upload if a new one is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $slider->image_path = $imagePath;
        }

        // Update the slider's attributes
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        $slider->order = $request->input('order', $slider->order); // Use the existing order if not provided

        // Save the changes to the database
        $slider->save();

        // Redirect with success message
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully!');
    }



    // Delete a slider image
    public function destroy($id)
    {
        $slider = Slider::find($id);

        // Delete the image from the server
        $filePath = public_path($slider->image_path);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider image deleted!');
    }
}
