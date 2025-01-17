<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\QuaidaDetail;

class QuaidaAppDetailController extends Controller
{
    public function QuaidaDetailApp($id){
        $data['data'] = QuaidaDetail::where('Quaida_id',$id)
    
        ->get();
        foreach ($data['data'] as $item) {
            $audioPath = public_path('Quranfolder/' . $item->audio1);
            $item->audio1 = asset('/Quranfolder/' . $item->audio1);
            
            // Get the file type (extension) and add it to the $item array
            $item->file_type = pathinfo($audioPath, PATHINFO_EXTENSION);
        }
    
        return response()->json($data);

    }


    public function QuaidaDetailAudio($quaidaId, $id){
        try {
            // Folder name where audio files are stored
            $folderName = '/Quranfolder';
    
            // Fetch the audio link from the database for the given Quaida_id and id
            $audioLink = QuaidaDetail::where('Quaida_id', $quaidaId)
                                     ->where('Words_id', $id)
                                     ->pluck('audio1')
                                     ->first();
    
            // If no audio link found, return a 404 response
            if (!$audioLink) {
                return response()->json(['error' => 'Audio not found for the provided IDs'], 404);
            }
    
            // Modify the audio link to include the full path with the folder name
            $fullAudioLink = asset($folderName . '/' . $audioLink);
    
            // Return the JSON response with the modified audio link
            return response()->json([
                'audio1' => $fullAudioLink,
            ]);
        } catch (\Exception $e) {
            // If any exception occurs, return a JSON response with the error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
        

}
