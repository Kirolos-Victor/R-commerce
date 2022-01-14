<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    public $timestamps = true;
    protected $fillable=['name_en','name_ar','vendor_id','is_hidden'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}
