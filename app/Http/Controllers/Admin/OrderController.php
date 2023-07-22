<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::all();
        return view('admin.order.order',[
            'orders'=>$orders
        ]);
    }

    public function orderStatus(Request $request){
        $after_explode = explode(',', $request->status);
        Order::where('order_id',$after_explode[0])->update([
            'status'=>$after_explode[1],
        ]);
        return back();
    }
}
