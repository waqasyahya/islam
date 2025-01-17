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
        Schema::create('bookmarks', function (Blueprint $table) {
              $table->id(); // Primary key
    $table->unsignedBigInteger('quaida_id'); // Foreign key referencing the quaida
    $table->timestamps();

    // Foreign key constraint
    $table->foreign('quaida_id')->references('id')->on('quaidas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
