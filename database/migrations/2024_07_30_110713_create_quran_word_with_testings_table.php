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
        Schema::create('quran_word_with_testings', function (Blueprint $table) {
            $table->id();
            
            $table->string('option_1');
            $table->string('option_2');
            $table->string('Quran_id');
            $table->string('audios_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_word_with_testings');
    }
};
