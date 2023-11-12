<?php

namespace Database\Factories;

use App\Models\Tourist;
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
        $phone = [
            '+12056543278',
            '+12058927431',
            '+12051234567',
            '+120599876543',
            '+12058765432',
            '+12055432789',
            '+12054567890',
            '+12051357924',
            '+12052468013',
            '+12057777777',
            '+12058888888',
            '+12059999999',
            '+12057654321',
            '+12052345678',
            '+12051111111',
            '+12052222222',
            '+12053333333',
            '+12054444444',
            '+12055555555',
            '+12056666666',
            '+12057771234',
            '+12058901234',
            '+12054321789',
            '+12055432198',
            '+12057890123',
            '+12056547890',
            '+12058907654',
            '+12051230987',
            '+12057896543',
            '+12058760123',
        ];

        $avatar = [
            'img31.jpg',
            'img32.jpg',
            'img33.jpg',
            'img34.jpg',
            'img35.jpg',
            'img36.jpg',
            'img37.jpg',
            'img38.jpg',
            'img39.jpg',
            'img40.jpg',
        ];
        $user = User::factory()->state(['type' => 'tourist'])->create();

        return [
            'id' => $user->id,
            'country' => $this->faker->country,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'avatar'=> $this->faker->unique()->randomElement($avatar),
            'phone' =>  $this->faker->unique()->randomElement($phone),
            // Add other tourist data attributes
        ];
    }
}

