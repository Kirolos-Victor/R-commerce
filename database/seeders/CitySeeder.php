<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
           'country_id'=>1,
            'name_en'=>'cairo',
            'name_ar'=>'القاهرة'
        ]);
    }
}
