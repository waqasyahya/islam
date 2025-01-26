<?php

namespace App\Http\Controllers\Api;
use App\Models\Quaida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuaidaAppController extends Controller
{
    /**
 * Retrieve all Quaida records and log the API request.
 * Returns JSON response with data, status, message, and record count.
   */
    public function QuaidaApp()
    {
        // Retrieve all records from the Quaida model
        $data = Quaida::all();
    
        // Log the API call with additional details using the custom log function
        addLApiChecked('QuaidaApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'record_count' => $data->count(),
        ]);
    
        // Return the JSON response with additional information
        return response()->json([
            
            'data' => $data,
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'record_count' => $data->count()
        ]);
    }
    
    public function compareVoicesapp(Request $request)
    {
        $request->validate([
            'audio_file1' => 'required|mimes:wav,mp3',
            'audio_file2' => 'required|mimes:wav,mp3',
        ]);
        try {
            $file1Path = $request->file('audio_file1')->getPathname();
            $file2Path = $request->file('audio_file2')->getPathname();
            if (!file_exists($file1Path) || !file_exists($file2Path)) {
                return response()->json(['error' => 'One or both files do not exist.']);
            }
            if (!is_readable($file1Path) || !is_readable($file2Path)) {
                return response()->json(['error' => 'One or both files are not readable.']);
            }
        
              $uploadUrl = 'https://quran-api-3bfp.onrender.com/api/compare-audio/';
            $ch = curl_init($uploadUrl);
            $fileData = [
                'audio_file1' => new \CURLFile($file1Path),
                'audio_file2' => new \CURLFile($file2Path)
            ];
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fileData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if ($response === false) {
                $error = curl_error($ch);
                return response()->json(['error' => $error]);
            }
            curl_close($ch);
            return $response;
        } catch (\Exception $e) {
            return "An error occurred: " . $e->getMessage();
        }
    }
    
}
