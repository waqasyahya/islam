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
        Schema::create('quran_guaides', function (Blueprint $table) {
            $table->id();
            $table->string('Quran_id');
            $table->string('youtube_videos');
            $table->string('DescriptionUrdu');
            $table->string('DescriptionEng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_guaides');
    }
};
