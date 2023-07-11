<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subcategory.index',[
            'subcategories'=>subcategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subcategory.create',[
            'categories'=>Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name'=> 'required|unique:subcategories',
            'category_id'=>'required',
            'image'=> 'required|image|file|max:2048',
        ];
        $validatedData = $request->validate($data);

        //image manage
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/subcategory/'), $imageName);
            $validatedData['image'] = $imageName;
        }
        Subcategory::create($validatedData);
        return back()->withSuccess('category insert success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategory.edit',[
            'categories' => Category::all(),
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $data = [
            'name'=> 'required',
            'category_id'=>'required',
            'image'=> 'image|file|max:2048',
        ];
        $validatedData = $request->validate($data);

        //image manage
        if($request->image == ''){
            $subcategory->update($validatedData);
        }
        else{
            //image delete if exists
            if($subcategory->image){
                if(file_exists('uploads/subcategory/'.$subcategory->image)){
                    unlink(public_path('uploads/subcategory/'.$subcategory->image));  
                }
            }
            //image upload
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/subcategory/'), $imageName);
            $validatedData['image'] = $imageName;
            $subcategory->update($validatedData);
        }
        return Redirect::route('subcategories.index')->withSuccess('subcategories updated!');
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        if($subcategory->image){
            if(file_exists('uploads/subcategory/'.$subcategory->image)){
                unlink(public_path('uploads/subcategory/'.$subcategory->image));  
            }
        }
        $subcategory->delete();
        return back()->withSuccess('deleted!');  
    }
}
