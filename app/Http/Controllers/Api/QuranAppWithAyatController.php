<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranWithAyat;
use Illuminate\Http\Request;

class QuranAppWithAyatController extends Controller
{
    public function QuranWithAyat($quranId)
    {
        // Retrieve Quran data for the given quranId and order by 'id'
        $data['data'] = QuranWithAyat::where('Quran_id', $quranId)->orderBy('id')->get();
        
        // Log the API call with additional details
        addLApiChecked('QuranWithAyat API Called', [
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
        foreach ($data['data'] as $index => $detail) {
            $ayahNumber = $detail->id;
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
    



       public function QuranAyatAudio($ayahId){
        // Fetch the specific ayah based on the provided Ayah_id
        $ayah = QuranWithAyat::find($ayahId);
    
        // Check if the ayah exists
        if (!$ayah) {
            // If no data is found, return a response with a message
            return response()->view('no-data-found', [], 404);
        }
    
        // Fetch audio link from the Alquran API for the specified Ayah_id
        $edition = 'ar.alafasy'; // Choose the desired edition
        $audioUrl = 'https://cdn.islamic.network/quran/audio/128/' . $edition . '/' . $ayahId . '.mp3';
    
        // Return the JSON response with the audio URL
        return response()->json([
            'audio_url' => $audioUrl,
        ]);
    }


    public function QuranAyatAudioSurah($quranId, $ayahId){
        // Fetch the specific ayah based on the provided Quran_id and Ayah_id
        $ayah = QuranWithAyat::where('Quran_id', $quranId)
                         ->where('id', $ayahId)
                         ->first();
    
        // Check if the ayah exists
        if (!$ayah) {
            // If no data is found, return a response with a message
            return response()->view('no-data-found', [], 404);
        }
    
        // Fetch audio link from the Alquran API for the specified Quran_id and Ayah_id
        $edition = 'ar.alafasy'; // Choose the desired edition
        $audioUrl = 'https://cdn.islamic.network/quran/audio/128/' . $edition . '/' . $ayahId . '.mp3';
    
        // Return the JSON response with the audio URL
        return response()->json([
            'audio_url' => $audioUrl,
        ]);
    } 

    public function surahayat($quranId){
        $data['data'] = QuranWithAyat::where('Quran_id', $quranId)->orderBy('id')->get();
        $edition = 'ar.alafasy'; // Choose the desired edition
        $baseSurahAudio= 'https://cdn.islamic.network/quran/audio-surah/128/'.$edition.'/';
        foreach ($data['data'] as $index => $detail) {
            $surahNumber= $detail->Quran_id;
            $audioSurahUrl= $baseSurahAudio . $surahNumber . '.mp3';
          
            $data['data'][$index]->AusioSurah = $audioSurahUrl;
        }
   return response()->json($data);
}
   
}
