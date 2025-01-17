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
        Schema::create('islameapps', function (Blueprint $table) {
            $table->id();
            $table->string('Hadith_Name');
            $table->string('Hadith_Referance');
            $table->string('Hadith_Arabic');
            $table->string('Hadith_Translate');
            $table->string('Ayat_Name');
            $table->string('Ayat_Referance');
            $table->string('Ayat_Arabic');
            $table->string('Ayat_Translate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('islameapps');
    }
};
