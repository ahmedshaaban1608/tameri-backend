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
        Schema::create('tourguides', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->string("gender");
            $table->date("birth_date");
            $table->string("bio");
            $table->string("description");
            $table->string("avatar")->nullable();
            $table->string("profile_img");
            $table->integer("day_price");
            $table->string("phone");
            $table->timestamps();
            

          
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourguides');
    }
};
