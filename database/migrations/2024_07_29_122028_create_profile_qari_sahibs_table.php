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
        Schema::create('profile_qari_sahibs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language');
            $table->string('phone_number');
            $table->string('email');
            $table->string('rate');
            $table->string('gender');
            $table->string('location');
            $table->string('experience');
            $table->string('about');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_qari_sahibs');
    }
};
