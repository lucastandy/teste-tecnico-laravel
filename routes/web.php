<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleCompletedController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SaleItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/users',[UserController::class,'store'])->name('users.store');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::get('/users',[UserController::class,'index'])->name('users.index');

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('admin.dashboard.index');})->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Customers
    Route::get('/index-customer', [CustomersController::class, 'index'])->name('customer.index');
    Route::get('/create-customer', [CustomersController::class, 'create'])->name('customer.create');
    Route::post('/store-customer', [CustomersController::class, 'store'])->name('customer.store');
    Route::get('/show-customer/{customer}', [CustomersController::class, 'show'])->name('customer.show');
    Route::get('/edit-customer/{customer}', [CustomersController::class, 'edit'])->name('customer.edit');
    Route::put('/edit-customer/{customer}', [CustomersController::class, 'update'])->name('customer.update');
    Route::delete('/destroy-customer/{customer}', [CustomersController::class, 'destroy'])->name('customer.destroy');


    // Coupons
    Route::get('/index-coupon', [CouponsController::class, 'index'])->name('coupon.index');
    Route::get('/create-coupon', [CouponsController::class, 'create'])->name('coupon.create');
    Route::post('/store-coupon', [CouponsController::class, 'store'])->name('coupon.store');
    Route::get('/show-coupon/{coupon}', [CouponsController::class, 'show'])->name('coupon.show');
    Route::get('/edit-coupon/{coupon}', [CouponsController::class, 'edit'])->name('coupon.edit');
    Route::put('/edit-coupon/{coupon}', [CouponsController::class, 'update'])->name('coupon.update');
    Route::delete('/destroy-coupon/{coupon}', [CouponsController::class, 'destroy'])->name('coupon.destroy');


    // Categories
    Route::get('/index-category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/show-category/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/edit-category/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/edit-category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/destroy-category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Products
    Route::get('/index-product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create-product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store-product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/show-product/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/edit-product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/destroy-product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Sales
    Route::get('/index-sale', [SaleController::class, 'index'])->name('sale.index');
    Route::get('/create-sale', [SaleController::class, 'create'])->name('sale.create');
    Route::post('/store-sale', [SaleController::class, 'store'])->name('sale.store');
    Route::get('/show-sale/{code_sale}', [SaleController::class, 'show'])->name('sale.show');
    Route::get('/edit-sale/{sale}', [SaleController::class, 'edit'])->name('sale.edit');
    Route::delete('/destroy-sale/{sale}', [SaleController::class, 'destroy'])->name('sale.destroy');

    // Sales Items
    Route::get('/index-sale-item', [SaleItemController::class, 'index'])->name('sale_item.index');
    Route::get('/create-sale-item/{code_sale}', [SaleItemController::class, 'create'])->name('sale_item.create');
    Route::post('/store-sale-item', [SaleItemController::class, 'store'])->name('sale_item.store');
    Route::get('/show-sale-item/{sale_item}', [SaleItemController::class, 'show'])->name('sale_item.show');
    Route::get('/edit-sale-item/{sale_item}', [SaleItemController::class, 'edit'])->name('sale_item.edit');
    Route::delete('/destroy-sale-item/{id}', [SaleItemController::class, 'destroy'])->name('sale_item.destroy');

    // Finalize sale
    Route::post('/store-', [SaleCompletedController::class, 'store'])->name('sale_completed.store');


});

require __DIR__.'/auth.php';
