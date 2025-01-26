<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranAyatWithTesting;
use Illuminate\Http\Request;

class QuranAppAyatWithTestingController extends Controller
{
    public function TestAyatApp($quranId)
    {
        // Retrieve data for the given quranId and order by 'id'
        $data['data'] = QuranAyatWithTesting::where('Quran_id', $quranId)->orderBy('id')->get();
    
        // Log the API call with additional details
        addLApiChecked('TestAyatApp API Called', [
            'endpoint' => request()->fullUrl(),
            'method' => request()->method(),
            'quran_id' => $quranId,
            'record_count' => $data['data']->count(),
        ]);
    
        // Check if any data was retrieved
        if ($data['data']->isEmpty()) {
            // If no data is found, return a response with a message and 404 status
            return response()->json([
                'status' => 404,
                'message' => 'No data found for the provided Quran ID.'
            ], 404);
        }
    
        // Base URL for audio files
        $edition = 'ar.alafasy'; // Choose the desired edition
        $baseAudioUrl = 'https://cdn.islamic.network/quran/audio/128/' . $edition . '/';
    
        // Loop through the data and add audio URLs
        foreach ($data['data'] as $index => $item) {
            $ayahNumber = $item->id;
            $audioUrl = $baseAudioUrl . $ayahNumber . '.mp3';
            $data['data'][$index]->audios = $audioUrl;
        }
    
        // Return the data with the added audio URLs
        return response()->json([
            'status' => 200,
            'data' => $data['data'],
            'message' => 'Data retrieved successfully'
        ]);
    }
    
}
