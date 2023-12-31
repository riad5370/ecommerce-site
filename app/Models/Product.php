<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    function rel_to_inventories(){
        return $this->hasMany(Inventory::class,'product_id');
    }
}
