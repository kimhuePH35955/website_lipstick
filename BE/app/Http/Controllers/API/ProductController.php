<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Trả về danh sách sản phẩm dưới dạng JSON
        $products = Product::with('categories')->orderBy('id', 'desc')->get();
        return response()->json($products);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->quantity = $data['quantity'];
        $product->sold = $data['sold'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->status = $data['status'] = 1;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = uploadFile('image', $request->file('image'));
            if ($data['image']) {
                $product->image = $data['image'];
            }
        }
        $product->save();

        if (isset($data['categories']) && is_array($data['categories'])) {
            foreach ($data['categories'] as $categoryId) {
                DB::table('product_categories')->insert([
                    'product_id' => $product->id,
                    'category_id' => $categoryId,
                ]);
            }
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product]);
    }

    public function show($id)
    {
        $product = Product::with('categories')->find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->update($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = uploadFile('image', $request->file('image'));
            if ($data['image']) {
                $product->image = $data['image'];
            }
        }

        $categories = $request->input('categories', []);
        $product->categories()->sync($categories);

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
