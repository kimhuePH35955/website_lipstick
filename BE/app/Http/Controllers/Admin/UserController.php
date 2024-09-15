<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view("admin.user.user", compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $data['image'] = uploadFile('image', $request->file('image'));
        $user->image = $data['image'];
        $user->save();
        return redirect()->route('user');
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
        $model = User::find($id);
        return view('admin.user.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $capnhat = User::find($id);
    
        // Check if the product exists
        if (!$capnhat) {
            return redirect()->route('user')->with('error', 'Product not found');
        }
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Upload the new image
            $data['image'] = uploadFile('image', $request->file('image'));
            
            // Check if $data['image'] is a valid file path before assigning
            if ($data['image']) {
                $capnhat->image = $data['image'];
            } else {
                // Handle file upload error
                return redirect()->route('user')->with('error', 'Error uploading image');
            }
        }
        $capnhat->save();
    
        return redirect()->route('user')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $xoa = User::find($id);
        $xoa->delete();
        return redirect()->route('user');
    }
}
