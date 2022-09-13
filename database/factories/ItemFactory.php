<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status'=>'Active',
            'title' =>$this->faker->sentence(),
            'title_long'=>$this->faker->sentence(),
            'updated_by'=>'1',
            'publisher'=>$this->faker->company(),
            'publisher_when'=>$this->faker->date(),
            'publisher_where'=>$this->faker->city(),
            'type'=>'Book',
            //'subjects'=>$this->faker->word() . ',' .$this->faker->word() . ',' . $this->faker->word(),
            'language'=>$this->faker->word(),
            'description'=>$this->faker->paragraph(5),
            'provider'=>$this->faker->company(),
            'rights'=>$this->faker->url(),
            'ISBN'=>$this->faker->randomNumber(9, true),

        ];
    }
}
