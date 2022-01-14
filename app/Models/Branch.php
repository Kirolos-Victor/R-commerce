<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table='branches';
    public $timestamps = true;
    protected $fillable=['vendor_id','name_en','name_ar','phone_number','contact_person_number','address','longitude','latitude'];
}
