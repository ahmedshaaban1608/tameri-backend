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
        Schema::create('tourists', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
        //     $table->id();
        //    $table->foreignId("user_id")->constrained('users')->onUpdate("cascade")->onDelete("cascade")->unique();
            $table->string('country');
            $table->string('gender');
            $table->string('avatar')->nullable();
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourists');
    }
};
