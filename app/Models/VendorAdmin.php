<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VendorAdmin extends Authenticatable
{
    use HasFactory;
    protected $table='vendor_admins';
    public $timestamps = true;
    protected $fillable=['name','email','password','type','vendor_id'];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function branches(){
        return $this->hasMany(VendorAdminBranch::class,'vendor_admin_id','id');
    }

}
