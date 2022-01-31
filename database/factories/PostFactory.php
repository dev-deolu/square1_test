<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = \App\Models\User::all();
        $user = $users->random(1);
        return [
            'user_id' => $user->last()->id,
            'title' => $this->faker->realText(50),
            'description' => $this->faker->realText(500),
            'publication_date' => $this->faker->date()
        ];
    }
}
