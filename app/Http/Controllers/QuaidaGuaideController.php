<?php

namespace App\Http\Controllers;

use App\Models\QuaidaGuaide;
use Illuminate\Http\Request;
use App\Models\QuranGuaide;

class QuaidaGuaideController extends Controller
{
    public function index()
    {
        if (hasPermission('QuaidaGuaide_read')) {
            $data = QuaidaGuaide::all();
            return view("AdminPanel.QuaidaGuaide.index", $data);
        } else {
            abort(403);
        }
    }
  
  
    public function read()
    {
        try {
            if (hasPermission('QuaidaGuaide_read')) {
                $lesson = QuaidaGuaide::get();
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
            if (hasPermission('QuaidaGuaide_write')) {
                if ($request->id == "") {
                    $Guaideness = new QuaidaGuaide();
                    $Guaideness->Quaida_id = $request->Quaida_id;
                    $Guaideness->youtube_videos = $request->youtube_videos;
                    $Guaideness->DescriptionUrdu = $request->DescriptionUrdu;
                    $Guaideness->DescriptionEng = $request->DescriptionEng;
                  

                    $Guaideness->save();
                } else {
                    $Guaideness = QuaidaGuaide::find($request->id);
                    $Guaideness->Quaida_id = $request->Quaida_id;
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
  
    public function readById(QuaidaGuaide $guaideness, $id)
    {
        try {
            if (hasPermission('QuaidaGuaide_read')) {
                $data = QuaidaGuaide::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
    public function destroy(QuaidaGuaide $guaideness, $id)
    {
        $data = QuaidaGuaide::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
