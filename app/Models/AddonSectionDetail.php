<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonSectionDetail extends Model
{
    use HasFactory;
    protected $table='addon_attributes';
    public $timestamps = true;
    protected $fillable=['addon_id','name_en','name_ar','price'];
}
