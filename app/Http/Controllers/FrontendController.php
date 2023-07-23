<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::all();
        $products = Product::paginate(16);

        $best_selling_product = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')
        ->orderBy('quantity','Desc')
        ->havingRaw('sum >= 1')
        ->get();
        return view('frontend.index',[
            'products'=>$products,
            'best_selling_product'=>$best_selling_product,
            'categories' => $categories
        ]);
    }

    public function categoryProduct($category_id){
        $category_name = Category::find($category_id);
        $category_products = Product::where('category_id', $category_id)->paginate('16');
        return view('frontend.page.category-product',[
            'category_products'=>$category_products,
            'category_name' => $category_name
        ]);
    }

    public function details($slug){
        $product_info = Product::where('slug',$slug)->first();

        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->get();

        $thamnails = Thumbnail::where('product_id',$product_info->id)->get();
        $availabe_colors = Inventory::where('product_id', $product_info->id)
        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')->get();

        //customer-review
        $reviews = OrderProduct::where('product_id',$product_info->id)->whereNotNull('review')->get();
        $total_review = OrderProduct::where('product_id',$product_info->id)->whereNotNull('review')->count();
        $total_star = OrderProduct::where('product_id',$product_info->id)->whereNotNull('review')->sum('star');

        //product-size
        $sizes = Size::all();
        return view('frontend.page.details',[
            'product_info'=>$product_info,
            'thamnails'=>$thamnails,
            'availabe_colors'=>$availabe_colors,
            'sizes'=>$sizes,
            'related_products'=>$related_products,
            'reviews'=> $reviews,
            'total_review'=>$total_review,
            'total_star'=>$total_star
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

    function cart(Request $request)
    {
        $coupon = $request->coupon;
        $message = null;
        $type = null;

        if($coupon == ''){
            $discount = 0;
        }
        else {
            if(Coupon::where('name', $coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupon::where('name', $coupon)->first()->expire){
                    $discount = 0;
                    $message = 'Coupon Code Expired!';
                }
                else{
                    $discount = Coupon::where('name', $coupon)->first()->discount;
                    $type = Coupon::where('name', $coupon)->first()->type;
                    
                } 
            }
            else{
                $discount = 0;
                $message = 'Invalid Coupon Code!';
            }
        }
        $carts = cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.cart',[
            'carts'=>$carts,
            'message'=>$message,
            'discount'=>$discount,
            'type'=>$type,
        ]);
    }
    //customer-order-page 
    public function myOrder(){
        $myorders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.my-order',compact('myorders'));
    }
}
