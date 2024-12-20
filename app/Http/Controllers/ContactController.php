<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contactus'); // Make sure this matches your Blade view name
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country_code' => 'required|string|max:5',
            'message' => 'required|string',
        ]);

        // Process the validated data (e.g., send an email, save to database, etc.)
        // ...

        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully!');
    }
}
