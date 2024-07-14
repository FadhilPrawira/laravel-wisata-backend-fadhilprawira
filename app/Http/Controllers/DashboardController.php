<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        $users = User::where('role', 'user')->get();
        $staffs = User::where('role', 'staff')->get();
        $categories = Category::all();
        $products = Product::all();
        $orders = Order::all();

        return view('pages.home.index', compact('users', 'admins', 'staffs', 'orders', 'categories', 'products'));
    }
}
