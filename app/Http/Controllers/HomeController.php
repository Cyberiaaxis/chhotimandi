<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chef;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('Client.pages.dashboard.index');
    }
}
