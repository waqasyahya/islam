<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuranWordWithTesting;

class QuranappWordWithTestingController extends Controller
{
    public function QuranWordTesting($id){
        $data['data'] = QuranWordWithTesting::where('Quran_id', $id)
    
            ->get();
          
        
        return response()->json($data);
    
    
    }
}
