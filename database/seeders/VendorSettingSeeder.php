<?php

namespace Database\Seeders;

use App\Models\VendorSetting;
use Illuminate\Database\Seeder;

class VendorSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VendorSetting::create([
           'vendor_id'=>1,
            'logo'=>'default.jpg',
            'cover'=>'default.jpg',
            'description'=>'test'
        ]);
    }
}
