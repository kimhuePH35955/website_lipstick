<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Orders::all();
        return view('admin.order.order', compact('order'));
    }
    public function user(Request $request, $id)
    {
        $order = Orders::find($id);
        if ($order) {
            $userId = $order->user_id;
            $user = User::find($userId);

            if ($user) {
                return view('admin.order.order_user', compact('user'));
            }
        }
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
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);
        $name = $validatedData['name'];
        $phone = $validatedData['phone'];
        $email = $validatedData['email'];
        $address = $validatedData['address'];
        $note = $request->input('note');
        $total = $request->input('total');
        if ($total <= 1) {
            return redirect()->route('cart')->with('error', 'Nhập sai số lượng');
        }
        $order = new Orders();
        $order->user_id = auth()->user()->id;
        $order->order_date = now();
        $order->total_order = $total;
        $order->name = $name;
        $order->phone = $phone;
        $order->email = $email;
        $order->address = $address;
        $order->note = $note;
        $order->status = 1;
        $order->save();
        $orderDetails = $request->input('orderDetails');
        foreach ($orderDetails as $detail) {
            $orderDetail = new OrderDetails();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $detail['product_id'];
            $orderDetail->quantity = $detail['quantity'];
            $orderDetail->total_product = $detail['subtotal'];
            $product = Product::find($detail['product_id']);

            if (!$product) {
                return redirect()->route('cart')->with('error', 'Sản phẩm không tồn tại');
            }
            if ($orderDetail->quantity > $product->quantity) {
                return redirect()->route('cart')->with('error', 'Số lượng sản phẩm không đủ');
            }
            $product->quantity -= $orderDetail->quantity;
            $product->sold += $orderDetail->quantity;
            $product->save();
            $orderDetail->save();
            toastr()->success('Đặt hàng thành công!');
        }
        $productIds = array_column($orderDetails, 'product_id');
        Carts::whereIn('product_id', $productIds)->delete(); 
        return response()->json(['message' => 'Order created successfully']);
    }
    public function updateStatus(Request $request, $id)
    {
        $item = Orders::find($id);

        if (!$item) {
            return response()->json(['message' => 'Không tìm thấy mục'], 404);
        }

        $newStatus = $request->input('status');

        // Kiểm tra xem nếu trạng thái đã hoàn thành hoặc đã hủy bỏ, thì không cho phép thay đổi
        if ($item->status == 4 || $item->status == 5) {
            toastr()->error('Không thể thay đổi trạng thái đơn hàng!');
            return response()->json(['success' => false, 'message' => 'Không thể thay đổi trạng thái đã hoàn thành hoặc đã hủy bỏ']);
        }

        $newReason = $request->input('reason');

        if (empty($newReason)) {
            $item->reason = null;
        }
        $item->status = $newStatus;
        $item->save();

        toastr()->success('Cập nhật trạng thái thành công!');
        return response()->json(['message' => 'Cập nhật trạng thái thành công'], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Orders::find($id);
        $newReason = $request->input('reason');
        $orderId = $request->input('orderId');
        $orderDetail =  OrderDetails::where('order_id', $orderId)->get();
        foreach ($orderDetail as $order) {
            $productId =  $order->product_id;
            $quantity = $order->quantity;
            $product = Product::find($productId);
            $product->quantity += $quantity;
            $product->sold -= $quantity;
            $product->save();
        }
        $item->reason =  $newReason;
        $item->save();
        return redirect()->back();
    }
    public function updateClient(Request $request, string $id)
    {
        $item = Orders::find($id);
        $newReason = $request->input('reason');
        $orderId = $request->input('orderId');
        $orderDetails = OrderDetails::where('order_id', $orderId)->get();
        foreach ($orderDetails as $order) {
            $productId = $order->product_id;
            $quantity = $order->quantity;
            $product = Product::find($productId);
            $product->quantity += $quantity;
            $product->sold -= $quantity;
            $product->save();
        }
        $item->reason = $newReason;
        $item->status = 5; 
        $item->save();

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $xoa = Orders::find($id);
        $xoa->delete();
        return redirect()->route('order');
    }
}
