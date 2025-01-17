<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quran;
use Illuminate\Http\Request;

class QuranAPPController extends Controller
{
    public function QuranApp(){
        $data =   Quran::all();
        return response()->json($data);

    }

}
