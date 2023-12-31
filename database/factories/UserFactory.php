<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */protected $model = User::class;
    public function definition(): array
    {
        $name = [
            "Ahmed", "Hamza", "Omar", "Ali", "Hossam",
            "Youssef", "Mohammad", "Tarek", "Yaaqoub", "Amir",
            "David", "Kareem", "Rafat", "Hesham", "Rawan",
            "Aisha", "Rwda", "Yara", "Noura", "Amal",
            "Layla", "Yasmine", "Omnia", "Nada", "Farida",
            "Sara", "Doaa", "Hassan", "Khaled", "Fatima"
        ];
        return [
            'type' =>$this->faker->randomElement(['tourist', 'tourguide']),
            'name' => $this->faker->randomElement($name),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('123456'), // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
