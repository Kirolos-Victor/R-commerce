<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;
    protected $table='promo_codes';
    public $timestamps = true;
    protected $fillable=['vendor_id','code','start_date','end_date','value','type','user_limit','minimum_total_cart_price','usage'];
}
