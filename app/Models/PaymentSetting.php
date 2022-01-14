<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;
    protected $table='payment_settings';
    public $timestamps=true;
    protected $fillable=['cash_on_delivery','knet','visa','vendor_id'];
}
