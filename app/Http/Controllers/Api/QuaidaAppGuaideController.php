<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuaidaGuaide;

class QuaidaAppGuaideController extends Controller
{
    public function QuaidaGuaideApp($id)
    {
        // Retrieve Quaida Guaide details based on the given Quaida_id
        $data['data'] = QuaidaGuaide::where('Quaida_id', $id)->get();  
        
        // Log the API call with additional details such as endpoint, method, and record count
        addLApiChecked('QuaidaGuaideApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
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
