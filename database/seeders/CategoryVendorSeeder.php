<?php

namespace Database\Seeders;

use App\Models\VendorCategory;
use Illuminate\Database\Seeder;

class CategoryVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VendorCategory::factory()->times(10)->create();
    }
}
