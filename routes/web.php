<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\CustromerRegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPasswordResetController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SslCommerzPaymentController;

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
Route::get('/wishlist',[FrontendController::class,'wishlist'])->name('wishlist.view');
Route::get('/my/order',[FrontendController::class,'myOrder'])->name('my.order');
Route::get('/category/product/{category_id}',[FrontendController::class,'categoryProduct'])->name('category.product');

//customer-Register-Login
Route::post('/customer/register',[CustromerRegisterController::class,'customerRegister'])->name('customer.register');
Route::post('/customer/login',[CustomerLoginController::class,'customerLogin'])->name('customer.login');
Route::get('/customer/logout',[CustomerLoginController::class,'Logout'])->name('customer.logout');

//password-Reset
Route::get('/forgot-password',[CustomerPasswordResetController::class,'index'])->name('forgot.password');
Route::Post('/password-reset-request',[CustomerPasswordResetController::class,'passResetRequest'])->name('reset.request');
Route::get('/password-reset-form/{token}',[CustomerPasswordResetController::class,'passResetForm'])->name('pass.reset.form');
Route::Post('/password-reset',[CustomerPasswordResetController::class,'passwordReset'])->name('password.reset');



//customer-profile
Route::get('/customer/profile',[CustomerController::class,'profile'])->name('customer.profile');
Route::post('/customer/profile-update',[CustomerController::class, 'profileUpdate'])->name('profile.update');

//customer-download-invoice
Route::get('/order/download/invoice/{order_id}',[CustomerController::class,'downloadInvoice'])->name('download.invoice');

//review
Route::post('/review/store',[CustomerController::class,'reviewStore'])->name('review.store');

//cart
Route::post('/add/cart',[CartController::class,'cartStore'])->name('add.cart');
Route::get('cart/remove/{id}',[CartController::class,'remove'])->name('cart.remove');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');

//wishlist
Route::post('/add/wishlist',[WishlistController::class,'wishlistStore'])->name('add.wishlist');
Route::get('wish/remove/{id}',[WishlistController::class,'remove'])->name('wish.remove');


//product-checkout
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
Route::get('/order/success/{abc}',[CheckoutController::class,'orderSuccess'])->name('order.success');

//searching..................
Route::get('/search',[SearchController::class,'search'])->name('search');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//stripe-payment-method
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


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

    //order
    Route::get('/orders',[OrderController::class,'orders'])->name('orders');
    Route::post('/order/status',[OrderController::class,'orderStatus'])->name('order.status');

    //role-manager-permission
    Route::get('/role',[RoleController::class,'role'])->name('role');
        //permission
    Route::post('/permission/store',[RoleController::class,'storePermission'])->name('permission.store');
        //Role-as-permission
    Route::post('/role/store',[RoleController::class,'storeRole'])->name('role.store');
    Route::get('/role/delete/permission/{role_id}',[RoleController::class,'delete_permission'])->name('delete.permission');
        //user-asign-role-permission
    Route::post('/assign/role',[RoleController::class,'assignRole'])->name('assign.role');
    Route::get('/remove/role/{id}',[RoleController::class,'removeRole'])->name('remove.role');
    Route::get('/role/permission/edit/{id}',[RoleController::class,'user_role_permission_edit'])->name('edit.user.permission');
    Route::post('/permission/update',[RoleController::class,'permissionUpdate'])->name('permission.update');
   




});
