<?php

namespace Database\Factories;

use App\Models\Tourguide;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Language::class;

    public function definition(): array
    {
        $tourguideId = Tourguide::inRandomOrder()->first()->id;
        return [
           'tourguide_id'=>$tourguideId,
           'language'=>$this->faker->languageCode

        ];
    }
}
