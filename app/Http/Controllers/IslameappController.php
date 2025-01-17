<?php

namespace App\Http\Controllers;

use App\Models\Islameapp;
use Illuminate\Http\Request;

class IslameappController extends Controller
{
    public function index()
    {
        if (hasPermission('Islameapp_read')) {
            $data = Islameapp::all();
            return view("AdminPanel.Islameapp.index", $data);
        } else {
            abort(403);
        }
    }
     public function read()
    {
        try {
            if (hasPermission('Islameapp_read')) {
                $lesson = Islameapp::get();
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
            if (hasPermission('Islameapp_write')) {
                if ($request->id == "") {
                    $lesson = new Islameapp();
                    $lesson->Hadith_Name = $request->Hadith_Name;
                    $lesson->Hadith_Referance = $request->Hadith_Referance;
                    $lesson->Hadith_Arabic = $request->Hadith_Arabic;
                    $lesson->Hadith_Translate = $request->Hadith_Translate;
                    $lesson->Ayat_Name = $request->Ayat_Name;
                    $lesson->Ayat_Referance = $request->Ayat_Referance;
                    $lesson->Ayat_Arabic = $request->Ayat_Arabic;
                    $lesson->Ayat_Translate = $request->Ayat_Translate;
                 
                    $lesson->save();
                } else {
                    $lesson = Islameapp::find($request->id);
                    $lesson->Hadith_Name = $request->Hadith_Name;
                    $lesson->Hadith_Referance = $request->Hadith_Referance;
                    $lesson->Hadith_Arabic = $request->Hadith_Arabic;
                    $lesson->Hadith_Translate = $request->Hadith_Translate;
                    $lesson->Ayat_Name = $request->Ayat_Name;
                    $lesson->Ayat_Referance = $request->Ayat_Referance;
                    $lesson->Ayat_Arabic = $request->Ayat_Arabic;
                    $lesson->Ayat_Translate = $request->Ayat_Translate;
                 
                    $lesson->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }

    public function readById(Islameapp $read, $id)
    {
        try {
            if (hasPermission('Islameapp_read')) {
                $data = Islameapp::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }






    public function destroy(Islameapp $lesson, $id)
    {
        $data = Islameapp::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
