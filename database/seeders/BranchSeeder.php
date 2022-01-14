<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
           'vendor_id'=>1,
            'name_en'=>'branch',
            'name_ar'=>'فرع',
            'address'=>'dsadasdas',
            'phone_number'=>31232131,
            'contact_person_number'=>312321321,
            'longitude'=>31.311111,
            'latitude'=>23.123213
        ]);
    }
}
