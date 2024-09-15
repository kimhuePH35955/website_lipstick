<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\Order_DetailController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\Blog_DetailController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\Order_UserController;
use App\Http\Controllers\Client\Shop_DetailController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\TendangnhapController;
use App\Http\Controllers\Client\User_DetailController;
use App\Http\Controllers\LoginController;
use App\Models\Orders;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ! Route đăng nhập và trang chủ
Route::match(['get', 'post'], '/', [HomeController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name('login');
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');

// ! Route cho trang cửa hàng và sản phẩm
Route::match(['get', 'post'], '/shop', [ShopController::class, 'index'])->name('shop');
Route::match(['get', 'post'], '/product_detail/{id}', [Shop_DetailController::class, 'index'])->name('product_detail');

// ! Route cho trang blog và chi tiết blog
Route::match(['get', 'post'], '/blog', [BlogController::class, 'index'])->name('blog');
Route::match(['get', 'post'], '/blog_detail', [Blog_DetailController::class, 'index'])->name('blog_detail');

// ! Route cho trang giới thiệu và liên hệ
Route::match(['get', 'post'], '/about', [AboutController::class, 'index'])->name('about');
Route::match(['get', 'post'], '/contact', [ContactController::class, 'index'])->name('contact');

// ! Route cho giỏ hàng và đơn hàng
Route::match(['get', 'post'], '/cart', [CartController::class, 'index'])->name('cart');
Route::match(['get', 'post'], '/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::match(['get', 'post'], '/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::match(['get', 'post'], '/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::match(['get', 'post'], '/order', [OrderController::class, 'index'])->name('order');
Route::match(['get', 'post'], '/order/store', [OrderController::class, 'store'])->name('order.store');
Route::match(['get', 'post'], '/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
Route::match(['get', 'post'], '/order/update/client/{id}', [OrderController::class, 'updateClient'])->name('order.client');
Route::match(['get', 'post'], '/order/status/{id}', [OrderController::class, 'updateStatus']);
Route::match(['get', 'post'], '/order/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
Route::match(['get', 'post'], '/order_detail/{id}', [Order_DetailController::class, 'index'])->name('orderdetail');
Route::match(['get', 'post'], '/order_user/{id}', [OrderController::class, 'user'])->name('orderuser');
Route::match(['get', 'post'], '/user_detail', [User_DetailController::class, 'index'])->name('userdetail');
Route::match(['get', 'post'], '/user_order/{id}', [Order_UserController::class, 'index'])->name('userorder');

// ! Route cho trang dashboard
Route::match(['get', 'post'], '/dashboard', [DashboardController::class, 'user'])->name('dashboard');
Route::match(['GET', 'POST'], '/dashboard/getMonthlyStats', [DashboardController::class, 'getMonthlyStats']);
Route::match(['GET', 'POST'], '/dashboard/getUserCounts', [DashboardController::class, 'getUserCounts']);
Route::match(['GET', 'POST'], '/dashboard/calendar/selected', [DashboardController::class, 'selectedCalendar'])->name('dashboard.calendar');
Route::match(['GET', 'POST'], '/dashboard/calendar', [DashboardController::class, 'calendar'])->name('dashboard.invoice.calendar');
Route::match(['GET', 'POST'], '/dashboard/getCountStatusCalendar', [DashboardController::class, 'getCountStatusCalendar']);
Route::match(['GET', 'POST'], '/dashboard/fetchDailyData', [DashboardController::class, 'fetchDailyData']);

// ! Route cho danh mục và sản phẩm
Route::match(['get', 'post'], '/category', [CategoryController::class, 'index'])->name('category');
Route::match(['get', 'post'], '/category/create', [CategoryController::class, 'create'])->name('category.add');
Route::match(['get', 'post'], '/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::match(['get', 'post'], '/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::match(['get', 'post'], '/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::match(['get', 'post'], '/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::match(['get', 'post'], '/table', [ProductController::class, 'index'])->name('table');
Route::match(['get', 'post'], '/table/add', [ProductController::class, 'create'])->name('table.add');
Route::match(['get', 'post'], '/table/store', [ProductController::class, 'store'])->name('table.store');
Route::match(['get', 'post'], '/table/edit/{id}', [ProductController::class, 'edit'])->name('table.edit');
Route::match(['get', 'post'], '/table/update/{id}', [ProductController::class, 'update'])->name('table.update');
Route::match(['get', 'post'], '/table/destroy/{id}', [ProductController::class, 'destroy'])->name('table.destroy');

// ! Route cho quản lý người dùng
Route::match(['get', 'post'], '/user', [UserController::class, 'index'])->name('user');
Route::match(['get', 'post'], '/user/create', [UserController::class, 'create'])->name('user.create');
Route::match(['get', 'post'], '/user/store', [UserController::class, 'store'])->name('user.store');
Route::match(['get', 'post'], '/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::match(['get', 'post'], '/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::match(['get', 'post'], '/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
// Route::match(['get','post'],'/post',[PostController::class,'index'])->name('post');
// Route::match(['get','post'],'/post/create',[PostController::class,'create'])->name('post.create');
// Route::match(['get','post'],'/post/store',[PostController::class,'store'])->name('post.store');
// Route::match(['get','post'],'/post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
// Route::match(['get','post'],'/post/update/{id}',[PostController::class,'update'])->name('post.update');
// Route::match(['get','post'],'/post/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');

// ! Route trang feedback
Route::match(['get', 'post'], '/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::match(['get', 'post'], '/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::match(['get', 'post'], '/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::match(['get', 'post'], '/feedback/edit/{id}', [FeedbackController::class, 'edit'])->name('feedback.edit');
Route::match(['get', 'post'], '/feedback/update/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
Route::match(['get', 'post'], '/feedback/destroy/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
