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
            $table->unsignedBigInteger('id')->primary();
            $table->string('country');
            $table->enum('gender', ['male', 'female']);
            $table->string('avatar')->nullable();
            $table->string('phone');
            $table->timestamps();
        });
    
        Schema::table('tourists', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
