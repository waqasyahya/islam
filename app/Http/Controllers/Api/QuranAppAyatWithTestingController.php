<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuranAyatWithTesting;
use Illuminate\Http\Request;

class QuranAppAyatWithTestingController extends Controller
{
    public function TestAyatApp($quranId){
    
        
        $data['data'] = QuranAyatWithTesting::where('Quran_id', $quranId)->orderBy('id')->get();
            $edition = 'ar.alafasy'; // Choose the desired edition
          $baseAudioUrl = 'https://cdn.islamic.network/quran/audio/128/' . $edition . '/';
          foreach ($data['data'] as $index => $item) {
              $ayahNumber = $item->id;
              $audioUrl = $baseAudioUrl . $ayahNumber . '.mp3';
              $data['data'][$index]->audios = $audioUrl;
          }
      return response()->json($data);
  
  
  }
}
