<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('frontend.index',[
            'products'=>$products
        ]);
    }
}
