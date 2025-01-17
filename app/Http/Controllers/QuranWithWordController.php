<?php

namespace App\Http\Controllers;

use App\Models\QuranWithWord;
use Illuminate\Http\Request;

class QuranWithWordController extends Controller
{
    public function index()
    {
        if (hasPermission('QuranWithWord_read')) {
            $data = QuranWithWord::paginate(1);
            return view("AdminPanel.QuranWithWord.index", $data);
        } else {
            abort(403);
        }
    }
  
  
  


    public function read()
    {
        try {
            if (hasPermission('QuranWithWord_read')) {
                $length = request()->input('length', 10);
                $start = request()->input('start', 0);
                
                // Paginate the records
                $lessons = QuranWithWord::offset($start)
                    ->limit($length)
                    ->get();
                
                $total = QuranWithWord::count(); // Total number of records
    
                return response()->json([
                    'draw' => (int) request()->input('draw'),
                    'data' => $lessons,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total, // Adjust if filtering is applied
                ]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }
    }

    
    


    public function store(Request $request)
    {

        try {
            if (hasPermission('QuranWithWord_write')) {
                if ($request->id == "") {
                    $Guaideness = new QuranWithWord();
                    $Guaideness->Quran_id = $request->Quran_id;
                    $Guaideness->QuranAyat_id = $request->QuranAyat_id;
                    $Guaideness->QuranWords_id = $request->QuranWords_id;
                    $Guaideness->Words_RomanEng = $request->Words_RomanEng;
                    $Guaideness->Words_Arabic1 = $request->Words_Arabic1;
                    $Guaideness->Words_Eng1 = $request->Words_Eng1;
                    $Guaideness->Words_Urdu1 = $request->Words_Urdu1;
                    $Guaideness->audios_link = $request->audios_link;
                  

                    $Guaideness->save();
                } else {
                    $Guaideness = QuranWithWord::find($request->id);
                    $Guaideness->Quran_id = $request->Quran_id;
                    $Guaideness->QuranAyat_id = $request->QuranAyat_id;
                    $Guaideness->QuranWords_id = $request->QuranWords_id;
                    $Guaideness->Words_RomanEng = $request->Words_RomanEng;
                    $Guaideness->Words_Arabic1 = $request->Words_Arabic1;
                    $Guaideness->Words_Eng1 = $request->Words_Eng1;
                    $Guaideness->Words_Urdu1 = $request->Words_Urdu1;
                    $Guaideness->audios_link = $request->audios_link;
                  
                    $Guaideness->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
  
    public function readById(QuranWithWord $guaideness, $id)
    {
        try {
            if (hasPermission('QuranWithWord_read')) {
                $data = QuranWithWord::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
    public function destroy(QuranWithWord $guaideness, $id)
    {
        $data = QuranWithWord::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
    }






