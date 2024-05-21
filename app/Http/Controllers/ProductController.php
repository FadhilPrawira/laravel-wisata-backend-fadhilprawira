<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all products. When keyword is available, filter the products by name. Order the products by ID in descending order
        $products = Product::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);

        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all categories
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('pages.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'criteria' => 'required',
            'favorite' => 'required|boolean',
        ]);

        // Create a new product
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;

        $product->save();

        // Check if image is not empty and file is uploaded
        if ($request->hasFile('image')) {

            // Store the new image
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->extension());

            // Update the product image path
            $product->image = 'products/' . $product->id . '.' . $image->extension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Get all categories
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('pages.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'criteria' => 'required',
            'favorite' => 'required|boolean',
        ]);

        // Find product by ID
        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;

        $product->save();

        //check if image is not empty
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Store the new image
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->extension());

            // Update the product image path
            $product->image = 'products/' . $product->id . '.' . $image->extension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find product by ID
        $product = Product::find($id);

        // Delete image
        Storage::delete('public/' . $product->image);

        // Delete product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
