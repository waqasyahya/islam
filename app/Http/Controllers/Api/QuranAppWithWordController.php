<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\QuranWithWord;
use Illuminate\Http\Request;

class QuranAppWithWordController extends Controller
{
    public function QuranWithWord($id)
    {
        $data['data'] = QuranWithWord::where('Quran_id', $id)->get();
        return response()->json($data);
    }


    public function QuranWordAudio($quranId, $quranAyatId, $quranWordsId){
        // Fetch the specific entry based on the provided Quran_id, QuranAyat_id, and QuranWords_id
        $entry = QuranWithWord::where('Quran_id', $quranId)
                           ->where('QuranAyat_id', $quranAyatId)
                           ->where('QuranWords_id', $quranWordsId)
                           ->first();
        // Check if the entry exists
        if (!$entry) {
            // If no data is found, return a response with a message
            return response()->view('no-data-found', [], 404);
        }
        return response()->json([
            'audio_link' => $entry->audios_link,
        ]);
    }

}
