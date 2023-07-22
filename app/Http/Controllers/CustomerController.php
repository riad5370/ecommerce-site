<?php

namespace App\Http\Controllers;

use App\Models\CustolerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function profile(){
        return view('frontend.page.customer-profile');
    }

    public function profileUpdate(Request $request){
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'country'=>$request->country,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
        $profile = CustolerLogin::find(Auth::guard('customerlogin')->id());

        if($request->password == ''){
            if($request->photo == ''){
                $profile->update($data);
                return back();
            }
            else{
                //image delete if exists
                if($profile->photo){
                    if(file_exists('uploads/customer/'.$profile->photo)){
                        unlink(public_path('uploads/customer/'.$profile->photo));  
                    }
                }
                //image upload
                $image = $request->file('photo');
                $imageName = Auth::guard('customerlogin')->id().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/uploads/customer/'), $imageName);
                $data['photo'] = $imageName;

                $profile->update($data);
                return back();
            }
        }
        else {
            if(Hash::check($request->old_password,Auth::guard('customerlogin')->user()->password)){
                $data['password'] = bcrypt($request->password);
                if($request->photo == ''){
                    $profile->update($data);
                    return back();
                }
                else{
                    //image delete if exists
                    if($profile->photo){
                        if(file_exists('uploads/customer/'.$profile->photo)){
                            unlink(public_path('uploads/customer/'.$profile->photo));  
                        }
                    }
                    //image upload
                    $image = $request->file('photo');
                    $imageName = Auth::guard('customerlogin')->id().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/uploads/customer/'), $imageName);
                    $data['photo'] = $imageName;
    
                    $profile->update($data);
                    return back();
                }
            }
            else{
                return back()->with('failled','current password is wrong!');
            }
        }
    }
}
