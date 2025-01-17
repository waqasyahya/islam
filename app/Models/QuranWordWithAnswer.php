<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuranWordWithAnswer extends Model
{

    protected $table = 'quran_word_with_answers'; // Replace with your actual table name

    // If you want to allow mass assignment on these fields
    protected $fillable = [
        'TestingWords_id',
        'correct_option',
    ];
    use HasFactory;
}
