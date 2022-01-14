<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    use HasFactory;
    protected $appends = [
        'subCategoriesCount'
    ];

    protected $table='vendor_categories';
    public $timestamps = true;
    protected $fillable=['parent_id','name_en','name_ar','image','is_active'];

    public function mainCategory($id)
    {
       return $this->where('id','=',$id)->value('name_en');
    }
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'category_vendors');
    }
    public function subCategories()
    {
        return $this->hasMany(VendorCategory::class, 'parent_id');
    }
    public function getSubCategoriesCountAttribute()
    {
        return $this->subCategories()->count();
    }
    public function toggleIsActive()
    {
        $this->is_active= !$this->is_active;
        return $this;
    }
}
