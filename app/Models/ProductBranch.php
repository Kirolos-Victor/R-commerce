<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBranch extends Model
{
    use HasFactory;
    protected $table='product_branches';
    public $timestamps=true;
    protected $fillable=['product_id','branch_id'];
}
