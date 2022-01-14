<?php

namespace Database\Seeders;

use App\Models\VendorCategory;
use Illuminate\Database\Seeder;

class VendorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //basic static categories
        VendorCategory::query()->insert(
            [
                [
                    'parent_id' => null,
                    'name_en' => 'flowers',
                    'name_ar' => 'ورود',
                ],

                [
                    'parent_id' => null,
                    'name_en' => 'perfumes',
                    'name_ar' => 'عطور',
                ],

                [
                    'parent_id' => null,
                    'name_en' => 'sweets',
                    'name_ar' => 'حلوي',
                ],
            ]
        );

    }
}
