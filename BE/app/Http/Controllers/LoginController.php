<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home'); 
        }
        if ($request->isMethod('POST')) {
           
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('home');
            } else {
                return redirect()->route('login');
            }
        }
        return view('admin.login.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function register(Request $request )
    {
        if ($request->isMethod('POST')) {
            $validate=$request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4|confirmed',
                'password_confirmation' => 'required',
                'name' => 'required'
            ],[
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Password không được để trống',
                'password.min' => 'Password phải lớn hơn 4 ký tự',
                'password.confirmed' => 'Password không khớp',
                'name.required' => 'Tên không được để trống',
                'password_confirmation.required' => 'Không được để trống mật khẩu nhập lại'
            ]);
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            if($user){
                return redirect()->route('login');
            }else{
                return redirect()->route('register');
            }
        }
        return view('admin.login.register');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
