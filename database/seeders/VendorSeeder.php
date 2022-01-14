<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
           'owner_admin_id'=>1,
            'name_en'=>'Kirolos',
            'name_ar'=>'كيرلس',
            'country_id'=>1,
            'url'=>'http://rayan.test/',
            'supplier_code'=>123,
            'sms_sender'=>null,
            'active'=>1,
            'location'=>'Tanta',
            'start_working_hours'=>'10:00 AM',
            'end_working_hours'=>'6:00 PM',
            'start_delivery_time'=>'25 mins',
            'end_delivery_time'=>'30 mins',
            'preorder_availability'=>1

        ]);
    }
}
