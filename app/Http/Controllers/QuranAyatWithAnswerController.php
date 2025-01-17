<?php

namespace App\Http\Controllers;

use App\Models\QuranAyatWithAnswer;
use Illuminate\Http\Request;

class QuranAyatWithAnswerController extends Controller
{  public function index()
    {
        if (hasPermission('QuranAyatWithAnswer_read')) {
            $data = QuranAyatWithAnswer::all();
            return view("AdminPanel.QuranAyatWithAnswer.index", $data);
        } else {
            abort(403);
        }
    }

    public function read()
    {
        try {
            if (hasPermission('QuranAyatWithAnswer_read')) {
                $answer = QuranAyatWithAnswer::get();
                $json_data["data"] = $answer;
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
            if (hasPermission('QuranAyatWithAnswer_write')) {
                if ($request->id == "") {
                    $answer = new QuranAyatWithAnswer();
                    $answer->TestingAyats_id = $request->TestingAyats_id;
                    $answer->correct_option = $request->correct_option;
                

                    $answer->save();
                } else {
                    $answer = QuranAyatWithAnswer::find($request->id);
                    $answer->TestingAyats_id = $request->TestingAyats_id;
                    $answer->correct_option = $request->correct_option;
                    $answer->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
  
    public function readById(QuranAyatWithAnswer $Answer, $id)
    {
        try {
            if (hasPermission('QuranAyatWithAnswer_read')) {
                $data = QuranAyatWithAnswer::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }


   
    public function destroy(QuranAyatWithAnswer $Answer, $id)
    {
        $data = QuranAyatWithAnswer::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
