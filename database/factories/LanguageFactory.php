<?php

namespace Database\Factories;

use App\Models\Tourguide;
use App\Models\Language;

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
       $languagesArr =  [
            "English",
            "Spanish",
            "French",
            "German",
            "Chinese",
            "Japanese",
            "Korean",
            "Arabic",
            "Russian",
            "Italian",
            "Portuguese",
            "Dutch",
            "Hindi",
            "Swedish",
            "Greek",
            "Turkish",
            "Vietnamese",
            "Bengali",
            "Farsi (Persian)",
        ];
        $tourguideId = Tourguide::inRandomOrder()->first()->id;
        return [
           'tourguide_id'=>$tourguideId,
           'language'=>$this->faker->randomElement($languagesArr),
        ];
    }
}
