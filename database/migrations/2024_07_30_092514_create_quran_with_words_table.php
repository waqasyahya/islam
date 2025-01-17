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
        Schema::create('quran_with_words', function (Blueprint $table) {
            $table->id();
            $table->string('Quran_id');
            $table->string('QuranAyat_id');
            $table->string('QuranWords_id');
            $table->string('Words_RomanEng');
            $table->string('Words_Arabic1');
            $table->string('Words_Eng1');
            $table->string('Words_Urdu1');
            $table->string('audios_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_with_words');
    }
};
