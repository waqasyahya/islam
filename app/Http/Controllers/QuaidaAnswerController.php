<?php

namespace App\Http\Controllers;

use App\Models\QuaidaAnswer;
use Illuminate\Http\Request;

class QuaidaAnswerController extends Controller
{
    public function index()
    {
        if (hasPermission('QuaidaAnswer_read')) {
            $data = QuaidaAnswer::all();
            return view("AdminPanel.QuaidaTestAnswer.index", $data);
        } else {
            abort(403);
        }
    }

    public function read()
    {
        try {
            if (hasPermission('QuaidaAnswer_read')) {
                $answer = QuaidaAnswer::get();
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
            if (hasPermission('QuaidaAnswer_write')) {
                if ($request->id == "") {
                    $answer = new QuaidaAnswer();
                    $answer->testing_id = $request->testing_id;
                    $answer->correct_option = $request->correct_option;


                    $answer->save();
                } else {
                    $answer = QuaidaAnswer::find($request->id);
                    $answer->testing_id = $request->testing_id;
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


    public function readById(QuaidaAnswer $Answer, $id)
    {
        try {
            if (hasPermission('QuaidaAnswer_read')) {
                $data = QuaidaAnswer::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }



    public function destroy(QuaidaAnswer $Answer, $id)
    {
        $data = QuaidaAnswer::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
