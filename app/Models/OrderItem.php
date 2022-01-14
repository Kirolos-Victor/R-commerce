<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table='order_items';
    public $timestamps=true;
    protected $fillable=['order_id','unit_price','discounted_price','quantity','product_name'];
    public function orderItemAddons(){
        return $this->hasMany(OrderItemAddon::class,'order_item_id','id');
    }
//    public function product(){
//        return $this->belongsTo(Product::class,'product_id','id');
//    }
}
