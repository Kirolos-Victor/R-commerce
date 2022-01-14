<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryHour extends Model
{
    use HasFactory;
    protected $table='delivery_hours';
    public $timestamps=true;
    protected $fillable=['zones_id','day','from','to'];


}
