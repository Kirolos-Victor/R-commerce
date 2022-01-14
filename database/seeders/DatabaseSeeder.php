<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(VendorAdminsSeeder::class);
        $this->call(VendorSettingSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(AdsSeeder::class);
        $this->call(VendorCategorySeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(AddonsSeeder::class);
        $this->call(AddonAttributeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
