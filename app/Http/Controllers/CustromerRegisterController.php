<?php

namespace App\Http\Controllers;

use App\Models\CustolerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustromerRegisterController extends Controller
{
    public function customerRegister(Request $request){
        $customer_data = [
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:8',
            'password_confirmation'=> 'required|same:password',
        ];
        $validateData = $request->validate($customer_data);
        $validateData['password'] = bcrypt($validateData['password']);

        CustolerLogin::create($validateData);
        return back()->withSuccess('Your Register successfully');
    }
}
