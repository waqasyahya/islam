<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranGuaide;
use Illuminate\Http\Request;

class QuranAppGuaideController extends Controller
{
    public function QuranAppGuaide($id){
     
        $data['data'] = QuranGuaide::where('Quran_id', $id)
        
        ->get();

        return response()->json($data);
    }
}
