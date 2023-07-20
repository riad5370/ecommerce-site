<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function cartStore(Request $request){
        if(Auth::guard('customerlogin')->id()){
            $request->validate([
               'color_id'=>'required',
               'size_id'=>'required',
               'quantity'=>'required',
            ]);
            $quantity = Inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity;

            if($quantity >= $request->quantity){
                if(Cart::where('product_id',$request->product_id)->where('customer_id',Auth::guard('customerlogin')->id())->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
                   Cart::where('product_id',$request->product_id)->where('customer_id',Auth::guard('customerlogin')->id())->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
                   return back()->with('success','Cart update Successfull');
                }
                else{
                   Cart::insert([
                      'customer_id'=>Auth::guard('customerlogin')->id(),
                      'product_id'=>$request->product_id,
                      'color_id'=>$request->color_id,
                      'size_id'=>$request->size_id,
                      'quantity'=>$request->quantity,
                      'created_at'=>Carbon::now(),
                   ]);
                   return back()->with('success','Cart Added Successfull');
                }
             }
             else{
                return back()->with('stock','out of stock, total stock:'.$quantity);
             }
        }
        else {
            return Redirect::route('customer.signup')->with('warning','Please Login To Add Card');
       }
    }
    public function remove($id){
        cart::find($id)->delete();
        return back();
    }
}
