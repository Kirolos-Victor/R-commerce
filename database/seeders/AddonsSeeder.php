<?php

namespace Database\Seeders;

use App\Models\AddonSection;
use Illuminate\Database\Seeder;

class AddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddonSection::factory()->times(10)->create();

    }
}
