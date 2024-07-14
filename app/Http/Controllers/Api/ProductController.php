<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

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
        })->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Products loaded successfully',
            'data' => $products
        ])->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            // 'description' => 'nullable',
            'price' => 'required',
            // 'stock' => 'required',
            'category_id' => 'required',
            // 'image' => 'required',
            // 'status' => 'required',
            'criteria' => 'required',
            // 'is_favorite' => 'required|boolean',
        ]);

        // Check if the form-data request has 'image' as key
        if ($request->hasFile('image')) {
            // Store the image in variable
            $product_image = $request->file('image');

            // Set the image name based on epoch time and extension based on MIME type
            $product_image_filename = time() . '.' . $product_image->extension();

            // Store the new image
            // Store the image in the storage
            $product_image->storeAs('public/products', $product_image_filename);

            // http://localhost:8000/storage/images/YOUR_IMAGE_NAME.EXTENSION
        }
        // Get all request data
        // $data = $request->all();

        // Create a new product
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        // Update the product image path in database
        // $product->image = $product_image_filename;
        // $product->status = $request->status;
        $product->criteria = $request->criteria;
        // $product->is_favorite = $request->is_favorite;
        // Save the product
        $product->save();


        $detailProduct = Product::with(
            'category'
        )->find($product->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'data' => $detailProduct
        ])->setStatusCode(201);
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
                'message' => 'Product not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // Product found
        return response()->json([
            'status' => 'success',
            'message' => 'Product loaded successfully',
            'data' => $product
        ])->setStatusCode(200);
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
                'message' => 'Product not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // Validate the request
        $request->validate([
            'name' => 'required',
            // 'description' => 'nullable',
            'price' => 'required',
            // 'stock' => 'required',
            // 'category_id' => 'required',
            // 'image' => 'required',
            // 'status' => 'required',
            // 'criteria' => 'required',
            // 'is_favorite' => 'required|boolean',
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
        // is_favorite:1
        // description:Parkir motor perorangan EDITED


        // Check if the form-data request has 'image' as key
        if ($request->hasFile('image')) {
            // Store the image in variable
            $product_image = $request->file('image');
            // Set the image name based on epoch time and extension based on MIME type
            $product_image_filename = time() . '.' . $product_image->extension();

            // Delete the old image if it exists
            if ($product->image) {
                // path to the image
                $old_image = 'public/products/' . $product->image;
                Storage::delete($old_image);
            }

            // Store the new image in the storage
            $product_image->storeAs('public/products', $product_image_filename);

            // http://localhost:8000/storage/images/YOUR_IMAGE_NAME.EXTENSION
        } else {
            // If the request does not have 'image' key
            // Set the product image to the old image
            $product_image_filename = $product->image;
        }

        // Get all request data
        $data = $request->all();

        // Update the product
        $product->update([
            'name' => $request->name,
            // 'description' => $request->description,
            'price' => $request->price,
            // 'stock' => $request->stock,
            // 'category_id' => $request->category_id,
            // Update the product image path in database
            // 'image' => $product_image_filename,
            // 'status' => $request->status,
            // 'criteria' => $request->criteria,
            // 'is_favorite' => $request->is_favorite,
        ]);

        $product->save();

        $detailProduct = Product::with(
            'category'
        )->find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'data' => $detailProduct
        ])->setStatusCode(200);
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
            ])->setStatusCode(404);
        }

        // Product found
        // Delete image
        Storage::delete('public/' . $product->image);

        // Delete product
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ])->setStatusCode(200);
    }
}
