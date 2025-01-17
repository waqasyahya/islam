<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuaidaDetail extends Model
{

    public function quaidaapp()
    {
        return $this->belongsTo(Quaida::class, 'Quaida_id', 'id');
    }

    use HasFactory;
}
