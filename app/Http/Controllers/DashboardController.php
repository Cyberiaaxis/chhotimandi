<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch sales data for the last 6 months
        $salesData = Order::where('status', 'completed')
            ->where('order_date', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('MONTH(order_date) as month, SUM(final_amount) as total_sales')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Total number of completed orders
        $totalOrders = Order::where('status', 'completed')->count();

        // Today's sales total
        $dailySales = Order::where('status', 'completed')
            ->whereDate('order_date', Carbon::today())
            ->sum('final_amount');

        // Stock levels data (categories with product counts)
        $stockLevels = Category::with('products:id,name,description,price,image,is_active,qty,category_id')
            ->withCount('products')
            ->get();

        // Fetch the total number of customers who made an order in the last month
        $customerData = Order::where('status', 'completed')
            ->where('order_date', '>=', Carbon::now()->subMonth()) // Last month
            ->selectRaw('MONTH(order_date) as month, COUNT(DISTINCT user_id) as total_customers')
            ->groupBy('month')
            ->get();

        // Fetch last month's incoming customers
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $incomingCustomers = Order::where('status', 'completed')
            ->whereBetween('order_date', [$lastMonthStart, $lastMonthEnd])
            ->select('user_id')
            ->distinct()
            ->whereDoesntHave('user.orders', function ($query) use ($lastMonthStart) {
                $query->where('order_date', '<', $lastMonthStart);
            })
            ->count();
        // dd($incomingCustomers);
        // Return the view with the data
        return view('Staff.pages.dashboard.index', compact('salesData', 'totalOrders', 'dailySales', 'stockLevels', 'customerData', 'incomingCustomers'));
    }
}
