<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{

    use HasFactory;

    protected $fillable = ['quaida_id', 'quran_id'];

    // Define the relationship with the Quaida model
    public function quaida()
    {
        return $this->belongsTo(Quaida::class, 'quaida_id');
    }
    public function quran()
    {
        return $this->belongsTo(Quran::class, 'quran_id');
    }
    use HasFactory;
}
