<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table='cities';
    public $timestamps = true;
    protected $fillable=['country_id','name_en','name_ar'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function areas(){
        return $this->hasMany(Area::class,'city_id','id');
    }
}
