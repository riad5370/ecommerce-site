<?php

namespace App\Http\Controllers;

use App\Models\Wishlish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlistStore(Request $request){

        $existingWishlist = Wishlish::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->first();

        if(!$existingWishlist){
        Wishlish::create([
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'product_id'=>$request->product_id,
        ]);
        return back()->withSuccess('wishlist add successfull!');
      }
      else{
        return back()->with('error', 'This product is already in your wishlist.');
      }
        
    }

    public function remove($id){
        Wishlish::find($id)->delete();
        return back();
    }
}
