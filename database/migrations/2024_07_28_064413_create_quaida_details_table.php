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
        Schema::create('quaida_details', function (Blueprint $table) {
            $table->id();
            $table->string('Quaida_id');
            $table->string('Words_Arabic');
            $table->string('Words_Eng');
            $table->string('Words_Urdu');
            $table->string('audio1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quaida_details');
    }
};
