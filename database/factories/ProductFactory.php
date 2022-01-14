<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_id'=>1,
            'name_en'=>$this->faker->text(10),
            'name_ar'=>'عربى',
            'description_en'=>$this->faker->text(10),
            'description_ar'=>'عربى',
            'amount'=>rand(10,20),
            'cost'=>rand(700,900),
            'price'=>rand(900,1000),
        ];
    }
}
