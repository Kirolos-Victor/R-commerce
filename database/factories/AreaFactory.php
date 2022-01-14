<?php

namespace Database\Factories;

use App\Models\Area;
use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arabic = Faker::create('ar_ar');

        return [
            'name_en'=>$this->faker->text(15),
            'name_ar'=>$arabic->text(10),
            'city_id'=>1
        ];
    }
}
