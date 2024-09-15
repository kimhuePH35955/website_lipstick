<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Carts::where('user_id', Auth::id())->count();
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)
            ->with('product')
            ->get();

        return view("client.cart.cart", compact('cart', 'count'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $model = $request->all();
        $userId = Auth::id();
        $product = Product::find($model['product_id']);
        if (!$product) {
            return redirect()->back()->with('Sản phẩm không tồn tại');
        }
        if($model['num-product'] < 1){
            toastr()->error('Chọn lại số lượng');
            return redirect()->back();
        }
        $existingCart = Carts::where('user_id', $userId)
            ->where('product_id', $model['product_id'])
            ->first();

        if ($existingCart) {
            if ($existingCart->quantity + $model['num-product'] > $product->quantity) {
                return redirect()->back()->with('error', 'Số lượng của sản phầm này không đủ');
            }

            $existingCart->quantity += $model['num-product'];
            $existingCart->save();

        }else {
            if ($model['num-product'] > $product->quantity) {
                return redirect()->back()->with('error', 'Số lượng của sản phầm này không đủ');
            }
            $cart = new Carts();
            $cart->product_id = $model['product_id'];
            $cart->user_id = $userId;
            $cart->quantity = $model['num-product'];
            $cart->save();
        }

        return redirect()->route('cart')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $xoa = Carts::find($id);
        $xoa->delete();
        return redirect()->route('cart')->with('success', 'Xóa giỏ hàng thành công');
    }
}
