<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDashboard extends Model
{
    use HasFactory;
    protected $table = 'admindashboard';

    // Enable mass assignment for these attributes
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
