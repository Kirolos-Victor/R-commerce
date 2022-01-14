<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = ['vendor_id', 'user_id', 'order_code', 'status', 'shipping_address', 'total', 'sub_total', 'total_discount', 'delivery_charges', 'payment_method', 'created_month', 'user_name', 'phone', 'order_type', 'branch_id', 'area_id', 'payment_status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function getCreatedAtAttribute($val)
    {
        return substr($val, 0, 10);
    }


    protected static function boot()
    {
        Parent::boot();
        Order::observe(OrderObserver::class);
    }

    /**
     * Get the order notification
     */
    public function notification()
    {
        return $this->morphOne(Notification::class, 'notifiable');
    }
}
