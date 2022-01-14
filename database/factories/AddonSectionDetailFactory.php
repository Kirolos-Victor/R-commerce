<?php

namespace Database\Factories;

use App\Models\AddonSectionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddonSectionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddonSectionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en'=>$this->faker->text(30),
            'name_ar'=>'عريى',
            'price'=>rand(100,1000),
            'addon_id'=>rand(1,10),
        ];
    }
}
