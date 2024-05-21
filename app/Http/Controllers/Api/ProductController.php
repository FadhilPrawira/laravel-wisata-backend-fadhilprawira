<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        // Get all products. When keyword is available, filter the products by name. Order the products by favorite in descending order
        $products = Product::with('category')->when($request->keyword, function ($query) use ($request) {
            $query->where('status', 'like', "%{$request->keyword}%");
        })->orderBy('favorite', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'image' => 'required',
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

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Search the product by id
        $product = Product::find($id);

        // If the product is not found
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        // Product found
        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Search the product by id
        $product = Product::find($id);

        // If the product is not found
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        // Validate the request
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'image' => 'sometimes',
            'status' => 'required',
            'criteria' => 'required',
            'favorite' => 'required|boolean',
        ]);

        //  In postman, use form-data to update the product and method POST.
        //  Use it like this

        // _method:PUT
        // image: YOUR_IMAGE_FILE (choose FILE not TEXT)
        // name:Parkir Motor EDITED
        // price:9000
        // stock:900
        // category_id:2
        // status:draft
        // criteria:rombongan
        // favorite:1
        // description:Parkir motor perorangan EDITED

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

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find product by ID
        $product = Product::find($id);

        // If the product is not found
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        // Product found
        // Delete image
        Storage::delete('public/' . $product->image);

        // Delete product
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
