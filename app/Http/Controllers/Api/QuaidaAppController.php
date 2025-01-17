<?php

namespace App\Http\Controllers\Api;
use App\Models\Quaida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuaidaAppController extends Controller
{
    public function QuaidaApp(){
        $data =   Quaida::all();
    return response()->json($data);


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
