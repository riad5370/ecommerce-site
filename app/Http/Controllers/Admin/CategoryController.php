<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index',[
            'categories'=>Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:categories',
            'image'=> 'image|file|max:2048',
        ]);
        $imageName = null;
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/category/'), $imageName);
        }
        Category::create([
            'name'=>$request->name,
            'icon'=>$request->icon,
            'image'=> $imageName, 
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);
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
    public function edit(Category $category)
    {
        return view('admin.category.edit',[
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=> 'required|unique:categories',
            'image'=> 'image|file|max:2048',
        ]);
        
        $imageName = $category->image;
        if ($request->file('image')) {
            if($category->image){
                if(file_exists('uploads/category/'.$category->image)){
                    unlink(public_path('uploads/category/'.$category->image));  
                }
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/category/'), $imageName);
        }
        $category->update([
            'name'=>$request->name,
            'icon'=>$request->icon,
            'image'=> $imageName,
        ]);
        return Redirect::route('categories.index')->withSuccess('category Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->image){
            if(file_exists('uploads/category/'.$category->image)){
                unlink(public_path('uploads/category/'.$category->image));  
            }
        }
        $category->delete();
        return back()->withSuccess('deleted!');   
    }
}
