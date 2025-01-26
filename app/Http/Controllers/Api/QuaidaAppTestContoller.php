<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuaidaTest;

class QuaidaAppTestContoller extends Controller
{
    public function TestApp($id)
    {
        // Retrieve Quaida test details based on the given Quaida_id
        $data['data'] = QuaidaTest::where('Quaida_id', $id)->get();
    
        // Loop through each item and modify the audio path and add file type
        foreach ($data['data'] as $item) {
            $audioPath = public_path('Quranfolder/' . $item->audio1);
            $item->audio1 = asset('/Quranfolder/' . $item->audio1);
            
            // Get the file type (extension) and add it to the $item array
            $item->file_type = pathinfo($audioPath, PATHINFO_EXTENSION);
        }
    
        // Log the API call with additional details such as endpoint, method, and record count
        addLApiChecked('TestApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'record_count' => $data['data']->count(),
        ]);
    
        // Return the JSON response with status, message, record count, and data
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'record_count' => $data['data']->count(),
            'data' => $data['data']
        ]);
    }
    
}
