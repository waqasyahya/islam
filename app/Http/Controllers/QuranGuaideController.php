<?php

namespace App\Http\Controllers;

use App\Models\QuranGuaide;
use Illuminate\Http\Request;

class QuranGuaideController extends Controller
{
    public function index()
    {
        if (hasPermission('QuranGuaide_read')) {
            $data = QuranGuaide::all();
            return view("AdminPanel.QuranGuaide.index", $data);
        } else {
            abort(403);
        }
    }
  
  
    public function read()
    {
        try {
            if (hasPermission('QuranGuaide_read')) {
                $lesson = QuranGuaide::get();
                $json_data["data"] = $lesson;
                return json_encode($json_data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }


    public function store(Request $request)
    {

        try {
            if (hasPermission('QuranGuaide_write')) {
                if ($request->id == "") {
                    $Guaideness = new QuranGuaide();
                 
                    $Guaideness->Quran_id = $request->Quran_id;
                    $Guaideness->youtube_videos = $request->youtube_videos;
                    $Guaideness->DescriptionUrdu = $request->DescriptionUrdu;
                    $Guaideness->DescriptionEng = $request->DescriptionEng;

                 

                    $Guaideness->save();
                } else {
                    $Guaideness = QuranGuaide::find($request->id);
                    $Guaideness->Quran_id = $request->Quran_id;
                    $Guaideness->youtube_videos = $request->youtube_videos;
                    $Guaideness->DescriptionUrdu = $request->DescriptionUrdu;
                    $Guaideness->DescriptionEng = $request->DescriptionEng;
                  
                 
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
  
    public function readById(QuranGuaide $guaideness, $id)
    {
        try {
            if (hasPermission('QuranGuaide_read')) {
                $data = QuranGuaide::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
    public function destroy(QuranGuaide $guaideness, $id)
    {
        $data = QuranGuaide::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
