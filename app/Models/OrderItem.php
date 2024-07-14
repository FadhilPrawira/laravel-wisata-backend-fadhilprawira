<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];

    /**
     * Get the one order that owns this order items.
     */
    public function order()
    {
        // One to many relationship (inverse)
        // Many order items belongs to one order
        // This will return the order that owns many order items
        // Di Tabel order_items ada field order_id yang menyimpan id orders.
        // Di Tabel orders tidak ada field yang menyimpan id order_items.
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the one product that owns this order items.
     */
    public function product()
    {
        // One to many relationship (inverse)
        // Many order items belongs to one product
        // This will return the product that owns many order items
        // Di Tabel order_items ada field product_id yang menyimpan id products.
        // Di Tabel products tidak ada field yang menyimpan id order_items.
        return $this->belongsTo(Product::class);
    }
}
