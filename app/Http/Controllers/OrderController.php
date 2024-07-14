<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('cashier')
            ->orderBy('transaction_time', 'desc')
            ->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('cashier')
            ->findOrFail($id);

        $orderItems = $order->orderItems;

        // Add total_price = price * quantity in $orderItems
        foreach ($orderItems as $item) {
            $item->total_price = $item->price * $item->quantity;
        }

        return view('pages.orders.show', compact('order', 'orderItems'));
    }
}
