<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranGuaide;
use Illuminate\Http\Request;

class QuranAppGuaideController extends Controller
{
    public function QuranAppGuaide($id)
    {
        // Retrieve QuranGuaide records based on the provided Quran_id
        $data['data'] = QuranGuaide::where('Quran_id', $id)->get();
    
        // Log the API call with additional details
        addLApiChecked('QuranAppGuaide API Called', [
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
