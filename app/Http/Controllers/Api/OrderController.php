<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'transaction_time' => 'required',
            'total_price' => 'required|integer',
            'total_item' => 'required|integer',
            'payment_amount' => 'required|integer',
            'cashier_id' => 'required|integer',
            'cashier_name' => 'required|string',
            'payment_method' => 'required|string',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|integer',
            'order_items.*.price' => 'required|integer',
            'order_items.*.quantity' => 'required|integer',
        ]);

        // Create a new order
        $order = Order::create([
            'transaction_time' => $request->transaction_time,
            'total_price' => $request->total_price,
            'total_item' => $request->total_item,
            'payment_amount' => $request->payment_amount,
            'cashier_id' => $request->cashier_id,
            'cashier_name' => $request->cashier_name,
            'payment_method' => $request->payment_method,
        ]);

        // Create order items
        foreach ($request->order_items as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Return the created order
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully',
            'order' => $order,
        ])->setStatusCode(201);
    }
}
