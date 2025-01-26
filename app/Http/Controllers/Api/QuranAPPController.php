<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quran;
use Illuminate\Http\Request;

class QuranAPPController extends Controller
{
    public function QuranApp()
    {
        // Retrieve all Quran records from the database
        $data = Quran::all();
    
        // Log the API call with additional details
        addLApiChecked('QuranApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'record_count' => $data->count(),
        ]);
    
        // Return the JSON response with status, message, and data
        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'record_count' => $data->count(),
            'data' => $data
        ]);
    }
    

}
