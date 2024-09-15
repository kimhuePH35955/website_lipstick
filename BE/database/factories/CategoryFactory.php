<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            "image"=>$this->faker->text(),
            "description"=>$this->faker->text(),
            "parent"=>$this->faker->text(),
            "slug"=>$this->faker->text(),
            "status"=>$this->faker->text(),
        ];
    }
}
