<?php

namespace Database\Seeders;

use App\Models\VendorAdmin;
use Illuminate\Database\Seeder;

class VendorAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        VendorAdmin::create([
            'name'=>'vendor_admin',
            'email'=>'vendor@gmail.com',
            'password'=>bcrypt("123456789"),
            'vendor_id'=>1,
            'type'=>'admin'
        ]);
    }
}
