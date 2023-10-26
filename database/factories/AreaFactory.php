<?php

namespace Database\Factories;

use App\Models\Tourguide;
use App\Models\Area;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Area::class;

    public function definition(): array
    {
        $tourguideId = Tourguide::inRandomOrder()->first()->id;
        return [
           'tourguide_id'=>$tourguideId,
           'area'=>$this->faker->city

        ];
    }
}
