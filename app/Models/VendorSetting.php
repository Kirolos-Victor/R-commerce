<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSetting extends Model
{
    use HasFactory;

    protected $table='vendor_settings';
    public $timestamps = true;
    protected $fillable=['vendor_id','logo','cover','description'];
}
