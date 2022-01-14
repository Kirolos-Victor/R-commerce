<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_id'=>1,
            'order_code'=>rand(100,1000),
            'status'=>'pending',
            'shipping_address'=>'random_area',
            'total'=>100,
            'sub_total'=>90,
            'total_discount'=>10,
            'delivery_charges'=>10,
            'payment_method'=>'visa',
            'created_month'=>Carbon::now()->format('Y-m'),
            'user_name'=>'test',
            'phone'=>'0128838383',
            'order_type'=>'pickup',
            'branch_id'=>1,
            'area_id'=>1,
            'payment_status'=>'pending'



        ];
    }
}
