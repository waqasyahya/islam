<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuaidaGuaide extends Model
{
    protected $table = 'quaida_guaides';

    // If you want to define fillable properties
    protected $fillable = ['Quran_id', 'youtube_videos', 'DescriptionUrdu','DescriptionEng'];
    use HasFactory;
}
