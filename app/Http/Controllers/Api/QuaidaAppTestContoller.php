<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuaidaTest;

class QuaidaAppTestContoller extends Controller
{
    public function TestApp($id) {
        $data['data'] = QuaidaTest::where('Quaida_id', $id)->get();
    
        // Assuming your audio files are stored in the "audiofolder" folder inside the public directory
        foreach ($data['data'] as $item) {
            $audioPath = public_path('Quranfolder/' . $item->audio1);
            $item->audio1 = asset('/Quranfolder/' . $item->audio1);
            
            // Get the file type (extension) and add it to the $item array
            $item->file_type = pathinfo($audioPath, PATHINFO_EXTENSION);
        }
    
        return response()->json($data);
    }
    
}
