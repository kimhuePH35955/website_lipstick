<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>$this->faker->name(),
            "quantity"=>$this->faker->text(),
            "size"=>$this->faker->text(),
            "image_size"=>$this->faker->text(),
            "color"=>$this->faker->text(),
            "sold"=>$this->faker->text(),
            "price"=>$this->faker->text(),
            "description"=>$this->faker->text(),
            "branch_id"=>$this->faker->text(),
        ];
    }
}
