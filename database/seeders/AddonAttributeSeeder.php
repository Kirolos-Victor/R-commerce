<?php

namespace Database\Seeders;

use App\Models\AddonSectionDetail;
use Illuminate\Database\Seeder;

class AddonAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddonSectionDetail::factory()->times(10)->create();

    }
}
