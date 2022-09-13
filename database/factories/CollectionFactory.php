<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status'=>'active',
            'title' =>$this->faker->sentence(),
            'created_by' => '1',
            'updated_by' => '1',
            'description' => $this->faker->paragraph(5)
        ];
    }
}
