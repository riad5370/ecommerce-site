<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\CustromerRegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Admin\CouponController;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/product-details/{slug}',[FrontendController::class,'details'])->name('details');
Route::post('/getsize',[FrontendController::class,'getsize']);
Route::get('/customer/signup',[FrontendController::class,'signup'])->name('customer.signup');
Route::get('/cart',[FrontendController::class,'cart'])->name('cart.view');

//customer-Register-Login
Route::post('/customer/register',[CustromerRegisterController::class,'customerRegister'])->name('customer.register');
Route::post('/customer/login',[CustomerLoginController::class,'customerLogin'])->name('customer.login');
Route::get('/customer/logout',[CustomerLoginController::class,'Logout'])->name('customer.logout');
//cart
Route::post('/add/cart',[CartController::class,'cartStore'])->name('add.cart');
Route::get('cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');

//product-checkout
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
    ->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    //category
    Route::resource('/categories',CategoryController::class);
    //subcategory
    Route::resource('/subcategories',SubcategoryController::class);
    //product
    Route::resource('/products',ProductController::class);
    Route::post('/getsubcategory',[ProductController::class,'getsubcategory']);
    Route::get('/products/inventory/{id}',[ProductController::class,'inventory'])->name('products.inventory');
    Route::post('/products/store',[ProductController::class,'inventoryStore'])->name('inventory.store');
    //product-variation
    Route::get('/product/variation',[VariationController::class,'productVariation'])->name('products.variation');
    Route::post('/product/variation/store',[VariationController::class,'variationStore'])->name('variation.store');
    // coupon
    Route::resource('/coupons',CouponController::class);



});
