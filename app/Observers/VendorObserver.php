<?php

namespace App\Observers;

use App\Models\PaymentSetting;
use App\Models\StoreSetting;
use App\Models\Vendor;

class VendorObserver
{

    public function created(Vendor $vendor)
    {
        PaymentSetting::create([
            'vendor_id'=>$vendor->id
        ]);
        StoreSetting::create([
            'vendor_id'=>$vendor->id,
            'name_en'=>$vendor->name_en,
            'name_ar'=>$vendor->name_ar

        ]);
    }

    /**
     * Handle the Vendor "updated" event.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return void
     */
    public function updated(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the Vendor "deleted" event.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return void
     */
    public function deleted(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the Vendor "restored" event.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return void
     */
    public function restored(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the Vendor "force deleted" event.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return void
     */
    public function forceDeleted(Vendor $vendor)
    {
        //
    }
}
