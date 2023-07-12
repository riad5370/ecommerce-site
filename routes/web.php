<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariationController;

use App\Http\Controllers\FrontendController;

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

});
