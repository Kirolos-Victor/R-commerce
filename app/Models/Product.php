<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    public $timestamps = true;
    protected $fillable=['vendor_id','name_en','name_ar','amount','description_en','description_ar','image','price','show_in_branch','is_hidden','cost'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function addons(){
        return $this->belongsToMany(AddonSection::class,'addons_products','product_id','addon_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'product_categories');
    }
    public function scopeExpiredProducts(){
        return $this->where('amount','<',5);
    }
}
