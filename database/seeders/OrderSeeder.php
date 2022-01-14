<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{

    public function run()
    {
        Order::withoutEvents(function (){
            Order::factory()->times(10)->create();

        });

    }
}
