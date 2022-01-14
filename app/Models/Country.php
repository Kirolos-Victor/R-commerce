<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table='countries';
    public $timestamps = true;
    protected $fillable=['name_en','name_ar'];
    public function stores(){
        return $this->hasMany(Vendor::class,'country_id','id');
    }
}
