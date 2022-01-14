<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonSection extends Model
{
    use HasFactory;
    protected $table='addons';
    public $timestamps = true;
    protected $fillable=['vendor_id','name_en','name_ar','must_select','quantity','hide_addon_item','quantity_meter'];
    //must_select (radio)= 2 multi_select(check box) = 1
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function addonDetails(){
        return $this->hasMany(AddonSectionDetail::class,'addon_id','id');
    }
}
