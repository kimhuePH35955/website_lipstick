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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('categories')->orderBy('id', 'desc')->get();
        return view("admin.table.table", compact("product"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.table.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->quantity = $data['quantity'];
        

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = uploadFile('image', $request->file('image'));
            // Check if $data['image'] is a valid file path before assigning
            if ($data['image']) {
                $product->image = $data['image'];
            } else {
                // Handle file upload error
            }
        }
        $product->sold = $data['sold'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->status = $data['status'] = 1;
        $product->save();


        $productId = $product->id;

        
        if (isset($data['categories']) && is_array($data['categories'])) {
         
            foreach ($data['categories'] as $categoryId) {
                DB::table('product_categories')->insert([
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                ]);
            }
            
        }
        return redirect()->route('table');
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
    public function edit(string $id)
    {
        $model = Product::find($id);
        $categories = Category::all();
        $productCategories = $model->categories->pluck('id')->toArray(); // Danh sách id của các danh mục mà sản phẩm đã có
        return view('admin.table.edit', compact('model', 'categories', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $capnhat = Product::find($id);
    
        // Check if the product exists
        if (!$capnhat) {
            return redirect()->route('table')->with('error', 'Product not found');
        }
    
        // Cập nhật thông tin sản phẩm từ request
        $capnhat->update($request->except('categories'));
        // Check if an image file is provided and is valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Upload the new image
            $data['image'] = uploadFile('image', $request->file('image'));
            
            // Check if $data['image'] is a valid file path before assigning
            if ($data['image']) {
                $capnhat->image = $data['image'];
            } else {
                // Handle file upload error
                return redirect()->route('table')->with('error', 'Error uploading image');
            }
        }
    
        // Lấy danh sách các danh mục từ form
        $categories = $request->input('categories', []);
    
        // Cập nhật lại danh mục cho sản phẩm
        $capnhat->categories()->sync($categories);
    
        // Save the changes
        $capnhat->save();
    
        return redirect()->route('table')->with('success', 'Product updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $xoa = Product::find($id);
        $xoa->delete();
        return redirect()->route('table');
    }
}
