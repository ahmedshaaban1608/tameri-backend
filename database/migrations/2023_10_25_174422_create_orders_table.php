<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tourist_id")->constrained('tourists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("guide_id")->constrained('tourists')->onUpdate('cascade')->onDelete('cascade');
            $table->string('comment');
            $table->timestamps();
            $table->string('phone', 20);
            $table->date('from');
            $table->date('to');
            $table->integer('total');
            $table->string('city', 30);
            $table->enum('status', ['pending', 'rejected', 'accepted'])->default('pending');





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
