<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GreetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'to'      => $this->faker->email,
            'message' => $this->faker->sentence,
        ];
    }
}
