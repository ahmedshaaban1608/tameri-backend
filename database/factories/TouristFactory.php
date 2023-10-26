<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tourist>
 */
class TouristFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tourist::class;
    public function definition(): array
    {
        $user = User::factory()->state(['type' => 'tourist'])->create();

        return [
            'id' => $user->id,
            'country' => $this->faker->country,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'avatar'=> $this->faker->imageUrl(),
            'phone' => $this->faker->phoneNumber,
            // Add other tourist data attributes
        ];
    }
}

