<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        if (request()->is('api/*')) {
            return response()->json($categories);
        }
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Tạo danh mục mới
        $category = Category::create($request->only('name', 'description'));

        if (request()->is('api/*')) {
            return response()->json($category, 201);
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::where('category_id', $id)->with('category')->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for this category.'], 404);
        }

        return response()->json($products);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::find($id);
        return view('admin.category.update', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // Xác thực dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cập nhật danh mục
        $category->update($request->only('name', 'description'));

        if (request()->is('api/*')) {
            return response()->json($category, 200);
        }
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if (request()->is('api/*')) {
            return response()->json(['message' => 'Category deleted successfully'], 200);
        }
        return redirect()->route('admin.category.index');
    }
}
