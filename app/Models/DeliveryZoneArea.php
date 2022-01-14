<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryZoneArea extends Model
{
    use HasFactory;
    protected $table="delivery_zone_areas";
    public $timestamps=true;
    protected $fillable=['zone_id','area_id'];
    public function area(){
        return $this->belongsTo(Area::class,'area_id','id');
    }
}
