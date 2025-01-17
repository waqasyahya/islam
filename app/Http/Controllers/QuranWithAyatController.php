<?php

namespace App\Http\Controllers;

use App\Models\QuranWithAyat;
use Illuminate\Http\Request;

class QuranWithAyatController extends Controller
{
    public function index()
    {
        if (hasPermission('QuranWithAyat_read')) {
            $data = QuranWithAyat::all();
            return view("AdminPanel.QuranWithAyat.index", $data);
        } else {
            abort(403);
        }
    }






 
    public function read()
    {
        try {
            if (hasPermission('QuranWithAyat_read')) {
                $lesson = QuranWithAyat::get();
                $json_data["data"] = $lesson;
                return json_encode($json_data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 
        try {
            if (hasPermission('QuranWithAyat_write')) {
                if ($request->id == "") {
                 $practic = new QuranWithAyat();
                 $practic->Quran_id = $request->input('Quran_id');
                 $practic->Ayat_id = $request->input('Ayat_id');
                 $practic->Ayat_Arabic= $request->input('Ayat_Arabic');
                 $practic->Ayat_Urdu= $request->input('Ayat_Urdu');
                 $practic->Ayat_Eng= $request->input('Ayat_Eng');
                $practic->Ayat_RomanEng= $request->input('Ayat_RomanEng');
                 $practic->save();
                } else {
                 $practic = QuranWithAyat::find($request->id);
                 $practic->Quran_id = $request->input('Quran_id');
                 $practic->Ayat_id = $request->input('Ayat_id');
                 $practic->Ayat_Arabic= $request->input('Ayat_Arabic');
                 $practic->Ayat_Urdu= $request->input('Ayat_Urdu');
                 $practic->Ayat_Eng= $request->input('Ayat_Eng');
                $practic->Ayat_RomanEng= $request->input('Ayat_RomanEng');
                 $practic->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
 
    public function readById(QuranWithAyat $read, $id)
    {
        try {
            if (hasPermission('QuranWithAyat_read')) {
                $data = QuranWithAyat::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
 
 
 
 
 
 
    public function destroy(QuranWithAyat $lesson, $id)
    {
        $data = QuranWithAyat::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
