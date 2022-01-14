<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemAddon extends Model
{
    use HasFactory;
    protected $table='order_item_addons';
    public $timestamps=true;
    protected $fillable=['order_item_id','addon_id','addon_unit_price','addon_quantity','addon_name'];

    public function addon(){
        return $this->belongsTo(AddonSectionDetail::class,'addon_id','id');
    }
}
