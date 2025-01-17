<?php

namespace App\Http\Controllers;

use App\Models\Quran;
use Illuminate\Http\Request;

class QuranController extends Controller
{




 
    public function index()
    {
        if (hasPermission('Quran_read')) {
            $data = Quran::all();
            return view("AdminPanel.Quran.index", $data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try {
            if (hasPermission('Quran_read')) {
                $lesson = Quran::get();
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
            if (hasPermission('Quran_write')) {
                if ($request->id == "") {
                    $lesson = new Quran();
                    $lesson->Quran_Name = $request->Quran_Name;
                    $lesson->Quran_words = $request->Quran_words;
                 
                    $lesson->save();
                } else {
                    $lesson = Quran::find($request->id);
                    $lesson->Quran_Name = $request->Quran_Name;
                    $lesson->Quran_words = $request->Quran_words;
                 
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

    public function readById(Quran $read, $id)
    {
        try {
            if (hasPermission('Quran_read')) {
                $data = Quran::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }






    public function destroy(Quran $lesson, $id)
    {
        $data = Quran::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
