<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuranWordWithTesting;

class QuranappWordWithTestingController extends Controller
{
    public function QuranWordTesting($id)
    {
        // Retrieve QuranWordWithTesting records based on the provided Quran_id
        $data['data'] = QuranWordWithTesting::where('Quran_id', $id)->get();
    
        // Log the API call with additional details
        addLApiChecked('QuranWordTesting API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'Quran_id' => $id,
            'record_count' => $data['data']->count(),
        ]);
    
        // Return the JSON response with status, message, and data
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'record_count' => $data['data']->count(),
            'data' => $data['data']
        ]);
    }
    
}
