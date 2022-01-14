<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVendor extends Model
{
    use HasFactory;
    protected $table='category_vendors';
    public $timestamps = true;
    protected $fillable=['vendor_category_id','vendor_id'];
    public function vendors()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}
