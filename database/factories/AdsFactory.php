<?php

namespace Database\Factories;

use App\Models\Ads;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ads::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_id'=>1,
            'title'=>$this->faker->text(30),
            'image'=>'images/ads/1KMS4bwB6ZqjlqfnX4rP6IAdFyCRGzlXSVnyyjOO.png',
            'type'=>$this->faker->randomElement(['flowers','chocolates','perfumes']),
        ];
    }
}
