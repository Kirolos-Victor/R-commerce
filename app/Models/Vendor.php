<?php

namespace App\Models;

use App\Observers\VendorObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';
    public $timestamps = true;
    protected $fillable = [
        'owner_admin_id',
        'name_en',
        'name_ar',
        'country_id',
        'url',
        'supplier_code',
        'sms_sender',
        'active',
        'location',
        'start_working_hours',
        'end_working_hours',
        'start_delivery_time',
        'end_delivery_time',
        'preorder_availability'
    ];
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function vendorCategories()
    {
        return $this->belongsToMany(VendorCategory::class, 'category_vendors');
    }

    public function vendorSetting()
    {
        return $this->hasOne(VendorSetting::class, 'vendor_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }

    public function addons()
    {
        return $this->hasMany(AddonSection::class, 'vendor_id', 'id');
    }

    protected static function boot()
    {
        Parent::boot();
        Vendor::observe(VendorObserver::class);
    }
    /**
     * Get the vendor notifications
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
