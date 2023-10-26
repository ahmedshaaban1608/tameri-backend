<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('tourist_id');
            $table->integer('guide_id');

            $table->string('title');
            $table->text('comment');
            $table->enum('stars', ['1','2', '3', '4', '5']);

            $table->timestamp('date')->nullable();
            $table->enum('status', ['pending', 'confirmed','declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
