<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAdminBranch extends Model
{
    use HasFactory;
    protected $table='vendor_admin_branches';
    public $timestamps=true;
    protected $fillable=['vendor_admin_id','branch_id'];
}
