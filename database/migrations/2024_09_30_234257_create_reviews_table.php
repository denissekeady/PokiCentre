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
            $table->string('title');
            $table->float('rating');
            $table->text('text');
            $table->integer('game_id');
            $table->integer('team_id')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('reviewee_id');
            $table->integer('reviewer_id');
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('reviewee_id')->references('id')->on('users');
            $table->foreign('reviewer_id')->references('id')->on('users');
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
