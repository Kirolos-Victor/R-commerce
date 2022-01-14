<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table='notifications';
    public $timestamps = true;
    protected $fillable=['notifiable_type','notifiable_id','readed','notified_type','notified_id','title','message'];

    /**
     * Get the parent notifiable object model (order).
     */
    public function notifiable()
    {
        return $this->morphTo();
    }


    /**
     * Get the parent notified object (user or vendor or admin).
     */
    public function notified()
    {
        return $this->morphTo();
    }
}
