<?php

namespace Database\Factories;

use App\Models\CategoryVendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryVendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryVendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_category_id'=>1,
            'vendor_id'=>1
        ];
    }
}
