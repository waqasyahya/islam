<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quran extends Model
{
    protected $fillable = ['bookmarked', 'Quran_Name', 'Quran_Words'];
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'quran_id');
    }
    use HasFactory;
}
