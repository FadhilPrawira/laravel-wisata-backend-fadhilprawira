<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image',
        'status',
        'criteria',
        'is_favorite',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'category_id' => 'integer',
            'favorite' => 'integer',
        ];
    }

    /**
     * Get the one category that owns this product.
     */
    public function category()
    {
        // One to many relationship (inverse)
        // Many products belongs to one category
        // This will return the category that owns many products
        // Di Tabel categories tidak ada field yang menyimpan id products.
        // Di Tabel products ada field category_id yang menyimpan id categories.
        return $this->belongsTo(Category::class);
    }
}
