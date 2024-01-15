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
        Schema::create('mankementje', function (Blueprint $table) {
            $table->id();
            $table->string('park');
            $table->string('location');
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->string('image');
            $table->integer('user_id');
            $table->string('status')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mankementje');
    }
};