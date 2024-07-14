<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_method',
        'payment_amount',
        'total_item',
        'total_price',
        'cashier_id',
        'cashier_name',
        'transaction_time',
    ];

    /**
     * Get the many order items for one order.
     */
    public function OrderItems(): HasMany
    {
        // One to many relationship
        // This order has many order items
        // This will return all order items that belong to this order
        // Di Tabel orders tidak ada field yang menyimpan id order_items.
        // Di Tabel order_items ada field order_id yang menyimpan id orders.
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the one user that owns this order.
     */
    public function cashier()
    {
        // One to many relationship (inverse)
        // Many orders belongs to one user
        // This will return the user that owns many orders
        // Di Tabel orders ada field cashier_id yang menyimpan id users.
        // Di Tabel users tidak ada field yang menyimpan id orders.
        return $this->belongsTo(User::class);
    }
}
