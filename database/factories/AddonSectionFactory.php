<?php

namespace Database\Factories;

use App\Models\AddonSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddonSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddonSection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_id'=>1,
            'name_en'=>$this->faker->text(30),
            'name_ar'=>'عريى',
            'must_select'=>1,
            'quantity'=>rand(1,10),
            'quantity_meter'=>0 //0 = unchecked 1 = checked
        ];
    }
}
