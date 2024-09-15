<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the cart items.
     */
    public function index()
    {
        $cartItems = Carts::all();  // Hoặc chỉ lấy các item của user hiện tại
        return response()->json([
            'status' => 'success',
            'data' => $cartItems
        ]);
    }

    /**
     * Store a newly created cart item.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $cartItem = new Carts();
        $cartItem->product_id = $data['product_id'];
        $cartItem->quantity = $data['quantity'];
        $cartItem->user_id = $data['user_id'];  // Gán user_id nếu cần thiết
        $cartItem->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart item added successfully',
            'data' => $cartItem
        ]);
    }

    /**
     * Update the specified cart item.
     */
    public function update(Request $request, $id)
    {
        $cartItem = Carts::find($id);
        if ($cartItem) {
            $cartItem->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Cart item updated successfully',
                'data' => $cartItem
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ], 404);
        }
    }

    /**
     * Remove the specified cart item from storage.
     */
    public function destroy($id)
    {
        $cartItem = Carts::find($id);
        if ($cartItem) {
            $cartItem->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Cart item deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ], 404);
        }
    }
}
