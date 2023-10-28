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
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date("birth_date");
            $table->string("bio");
            $table->text("description");
            $table->string("avatar")->nullable();
            $table->string("profile_img")->nullable();
            $table->integer("day_price")->nullable();
            $table->string("phone");
            $table->softDeletes();
            $table->timestamps();
               
        });
        Schema::table('tourguides', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
