<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get the many products for one category.
     */
    public function products(): HasMany
    {
        // One to many relationship
        // This category has many products
        // This will return all products that belong to this category
        // Di Tabel categories tidak ada field yang menyimpan id products.
        // Di Tabel products ada field category_id yang menyimpan id categories.
        return $this->hasMany(Product::class);
    }
}
