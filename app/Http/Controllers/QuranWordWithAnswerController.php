<?php

namespace App\Http\Controllers;

use App\Models\QuranWordWithAnswer;
use Illuminate\Http\Request;

class QuranWordWithAnswerController extends Controller
{
    public function index()
    {
        if (hasPermission('QuranWordWithAnswer_read')) {
            // Fetch 10 records per page
            $data = QuranWordWithAnswer::paginate(700);
            return view("AdminPanel.QuranWordWithAnswer.index", $data);
        } else {
            abort(403);
        }
    }
    
   
    public function read()
    {
        try {
            if (hasPermission('QuranWordWithAnswer_read')) {
                $length = request()->input('length', 10);
                $start = request()->input('start', 0);
                
                // Paginate the records
                $lessons = QuranWordWithAnswer::offset($start)
                    ->limit($length)
                    ->get();
                
                $total = QuranWordWithAnswer::count(); // Total number of records
    
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
            if (hasPermission('QuranWordWithAnswer_write')) {
                if ($request->id == "") {
                    $Guaideness = new QuranWordWithAnswer();
                    $Guaideness->TestingWords_id = $request->TestingWords_id;
                    $Guaideness->correct_option = $request->correct_option;
                    $Guaideness->save();
                } else {
                    $Guaideness = QuranWordWithAnswer::find($request->id);
                    $Guaideness->TestingWords_id = $request->TestingWords_id;
                    $Guaideness->correct_option = $request->correct_option;
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
  
    public function readById(QuranWordWithAnswer $guaideness, $id)
    {
        try {
            if (hasPermission('QuranWordWithAnswer_read')) {
                $data = QuranWordWithAnswer::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
    public function destroy(QuranWordWithAnswer $guaideness, $id)
    {
        $data = QuranWordWithAnswer::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
