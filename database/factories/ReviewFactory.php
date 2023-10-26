<?php

namespace Database\Factories;

use App\Models\Tourguide;
use App\Models\Tourist;
use App\Models\Review;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Review::class;
    public function definition(): array
    {
        $tourguideId = Tourguide::inRandomOrder()->first()->id;
        $touristId = Tourist::inRandomOrder()->first()->id;
        return [
            'tourist_id'=> $touristId,
            'tourguide_id'=> $tourguideId,
            'title'=>$this->faker->sentence,
            'comment'=>$this->faker->paragraph,
            'stars'=>$this->faker->numberBetween(1,5),
            'status'=>$this->faker->randomElement(['pending', 'confirmed', 'declined']),
        ];
    }
}
