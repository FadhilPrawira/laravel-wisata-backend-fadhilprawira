<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all categories
        $categories = Category::orderBy('name', 'ASC')->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ])->setStatusCode(200);
    }
}
