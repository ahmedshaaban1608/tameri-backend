<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tourguide;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tourguide>
 */
class TourguideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tourguide::class;

    public function definition(): array
    {
        $user = User::factory()->state(['type' => 'tourguide'])->create();
        return [
            'id' => $user->id,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->date,
            'bio'=> $this->faker->words(3, true),
            'description'=> $this->faker->paragraphs(2, true),
            'avatar'=> $this->faker->imageUrl(),
            'profile_img'=>$this->faker->imageUrl(),
            'day_price'=>$this->faker->numberBetween(50,100),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
