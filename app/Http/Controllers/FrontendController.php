<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Thumbnail;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('frontend.index',[
            'products'=>$products
        ]);
    }
    public function details($slug){
        $product_info = Product::where('slug',$slug)->first();
        $thamnails = Thumbnail::where('product_id',$product_info->id)->get();
        $availabe_colors = Inventory::where('product_id', $product_info->id)
        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')->get();
        $sizes = Size::all();
        return view('frontend.product.details',[
            'product_info'=>$product_info,
            'thamnails'=>$thamnails,
            'availabe_colors'=>$availabe_colors,
            'sizes'=>$sizes 
        ]);
    }
}
