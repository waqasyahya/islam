<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quaida extends Model
{
    protected $fillable = ['bookmarked', 'Quaida_Name', 'Quaida_Words'];

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'quaida_id');
    }

    public function QuaidaDetail()
    {
        return $this->hasMany(QuaidaDetail::class,'id','Quaida_id');
    }
    use HasFactory;
}
