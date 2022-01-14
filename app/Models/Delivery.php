<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table='zones';
    public $timestamps=true;
    protected $fillable=['branch_id','country_id','delivery_time','delivery_fees','vendor_id','longitude','latitude','radius','minimum_order_price','area','estimated_preparation_time'];

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
    public function deliveryHours(){
        return $this->hasMany(DeliveryHour::class,'zones_id','id');
    }
}
