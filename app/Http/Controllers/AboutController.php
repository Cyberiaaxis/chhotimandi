<?php

// app/Http/Controllers/AboutController.php
namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first(); // Fetch the first entry (assuming only one entry)
        return view('about', compact('about'));
    }
}
