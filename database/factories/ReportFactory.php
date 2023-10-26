<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Report;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Report::class;

    public function definition(): array
    {
        $userId = User::inRandomOrder()->first()->id;
        return [
            'user_id'=> $userId,
            'subject'=>$this->faker->sentence,
            'problem'=>$this->faker->paragraphs(2, true),
            'image'=>$this->faker->imageUrl(),
        ];
    }
}
