<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedbacks::with('users','products')->get();
        return view('admin.feedback.feedback',compact('feedback'));
    }

    
    public function create()
    {
        return view('client.shop.product_detail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $data = $request->all();
        $feedback = new Feedbacks();
        $feedback->user_id = $userId;
        $feedback->product_id = $data['product_id'];
        $feedback->content = $data['content'];
        $feedback->status = 1;
        $feedback->save();
        toastr()->success('Bình luận thành công');
        return redirect()->back();

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
        $model = Feedbacks::find($id);
        return view('admin.feedback.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $capnhat = Feedbacks::find($id);
        $capnhat->update($request->all());
        return redirect()->route('feedback');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $xoa = Feedbacks::find($id);
        $xoa->delete();
        return redirect()->route('feedback');
    }
}
