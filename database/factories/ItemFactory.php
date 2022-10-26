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
        $type = ['Book', 'Old Book', 'Manuscript', 'Map', 'Serial', 'Ex Libris', 'Photograph', 'Document', 'Postcard','Other'];;

        return [
            'status'=>1,
            'title' =>$this->faker->sentence(),
            'title_long'=>$this->faker->sentence(),
            'updated_by'=>'1',
            'publisher'=>$this->faker->company(),
            'publisher_day'=>$this->faker->dayOfMonth(),
            'publisher_month'=>$this->faker->month(),
            'publisher_year'=>$this->faker->year(),
            'publisher_where'=>$this->faker->city(),
            'type'=> $type[array_rand($type)],
            'language'=>$this->faker->languageCode(),
            'description'=>$this->faker->paragraph(5),
            'provider'=>$this->faker->company(),
            'rights'=>$this->faker->url(),
            'ISBN'=>$this->faker->randomNumber(9, true),

        ];
    }
}
