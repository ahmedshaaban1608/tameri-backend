<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Area;
use App\Models\Language;
use App\Models\Order;
use App\Models\Report;
use App\Models\Review;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Tourist::factory()->count(50)->create();
        Tourguide::factory()->count(50)->create();
        Area::factory()->count(200)->create();
        Language::factory()->count(200)->create();
        Order::factory()->count(100)->create();
        Review::factory()->count(100)->create();
        Report::factory()->count(50)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
