<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index',[
            'products'=>Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.product.create',[
            'categories' => Category::all(),
        ]);
    }

    public function getsubcategory(Request $request){
        $subcategories = Subcategory::where('category_id',$request->category)->get();

        $options  = '<option value="">--select category--</option>';
        foreach($subcategories as $subcategori){
            $options  .= '<option value="'.$subcategori->id.'">'.$subcategori->name.'</option>';
        }
        // echo $str;
        return response()->json(['options' => $options]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = Str::lower(str_replace(' ', '-', $request->name)) . '-' . rand(0, 100000000);
        $after_discount = $request->price - ($request->price * $request->discount / 100);

        $validationRules = [
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'discount' => 'nullable|numeric',
            'brand' => 'required',
            'short_desp' => 'required',
            'long_desp' => 'required',
            'preview' => 'required|image|file|max:1024',
        ];

        //validate data
        $validatedData = $request->validate($validationRules);

        // Add additional fields
        $validatedData['after_discount'] = $after_discount;
        $validatedData['slug'] = $slug;

        //preview image manage
        $image = $request->file('preview');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('/uploads/product/preview/'), $imageName);
        $validatedData['preview'] = $imageName;

       // Create the product
        $product = Product::create($validatedData);

        //thumbnail image
        foreach($request->thumbnail as $thumbnail){
            $imageName = Str::random(3).rand(100,999).$product->id.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/uploads/product/thumbnail/'), $imageName);
            Thumbnail::create([
                'product_id'=>$product->id,
                'thumbnail'=>$imageName,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->withSuccess('create new product!');
    }
    
    //inventory
    public function inventory($id){
        $inventories = Inventory::where('product_id',$id)->get();
        return view('admin.product.inventory',[
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'inventories'=>$inventories,
            'product' => Product::find($id)
        ]);
    }
    public function inventoryStore(Request $request){
        Inventory::create([
            'product_id'=>$request->product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
        ]);
        return back();
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
    public function edit(string $id)
    {
        return view('admin.product.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        $product = Product::find($product->id);
        
        if ($product) {
            $delete_preview = $product->preview;
        
            if ($delete_preview) {
                $delete_from_preview = public_path('uploads/product/preview/'.$delete_preview);
        
                if (file_exists($delete_from_preview)) {
                    unlink($delete_from_preview);
                }
            }
        
            $thumbnails = Thumbnail::where('product_id', $product->id)->get();
        
            foreach ($thumbnails as $thumbnail) {
                $delete_thum = $thumbnail->thumbnail;
                    // Rest of the code for deleting thumbnails
                $delete_from_thum = public_path('uploads/product/thumbnail/'.$delete_thum);

                if (file_exists($delete_from_thum)) {
                    unlink($delete_from_thum);
                }
            
                $thumbnail->delete();
            }
        
            $product->delete();
        }
        return back();    
    }
}
