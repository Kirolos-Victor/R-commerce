<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonsProduct extends Model
{
    use HasFactory;
    protected $table="addons_products";
    public $timestamps=true;
    protected $fillable=['product_id','addon_id'];
}
