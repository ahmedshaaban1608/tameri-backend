<?php

namespace Database\Factories;

use App\Models\Tourguide;
use App\Models\Tourist;
use App\Models\Order;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;
    public function definition(): array
    {
        $tourguideId = Tourguide::inRandomOrder()->first()->id;
        $touristId = Tourist::inRandomOrder()->first()->id;
        return [
            'tourist_id'=> $touristId,
            'tourguide_id'=> $tourguideId,
            'comment'=>$this->faker->paragraph,
            'phone'=>$this->faker->phoneNumber,
            'from'=>$this->faker->dateTimeBetween('now','+5 days'),
            'to'=>$this->faker->dateTimeBetween('+5 days','+10 days'),
            'total'=>$this->faker->numberBetween(300,50),
            'city'=> $this->faker->city,
            'status'=>$this->faker->randomElement(['pending', 'rejected', 'accepted']),
        ];
    }
}
