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
        Schema::create('quran_with_ayats', function (Blueprint $table) {
            $table->id();
            $table->string('Quran_id');
            $table->string('Ayat_Arabic');
            $table->string('Ayat_Eng');
            $table->string('Ayat_Urdu');
            $table->string('Ayat_RomanEng');

            $table->string('audio1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_with_ayats');
    }
};
