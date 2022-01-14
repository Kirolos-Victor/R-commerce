<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    use HasFactory;
    protected $table='store_settings';
    public $timestamps=true;
    protected $fillable=['name_en','name_ar','meta_description','logo','cover_image','phone','vendor_id'];
}
