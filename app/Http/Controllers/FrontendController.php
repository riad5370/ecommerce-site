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

        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->get();

        $thamnails = Thumbnail::where('product_id',$product_info->id)->get();
        $availabe_colors = Inventory::where('product_id', $product_info->id)
        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')->get();
        $sizes = Size::all();
        return view('frontend.product.details',[
            'product_info'=>$product_info,
            'thamnails'=>$thamnails,
            'availabe_colors'=>$availabe_colors,
            'sizes'=>$sizes,
            'related_products'=>$related_products
        ]);
    }
    public function getsize(Request $request){

        $sizes = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str = '';

        foreach($sizes as $size){
            $str .= '<div class="form-check size-option form-option form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="size_id" id="'.$size->size->id.'" value="'.$size->size->id.'">
                <label class="form-option-label" for="'.$size->size->id.'">'.$size->size->name.'</label>
                </div>';
        }
        echo $str;
       
    }
    public function signup(){
        return view('frontend.auth.customer-regi-login');
    }
}
