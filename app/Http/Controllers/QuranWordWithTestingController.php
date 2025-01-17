<?php

namespace App\Http\Controllers;

use App\Models\QuranWordWithTesting;
use Illuminate\Http\Request;

class QuranWordWithTestingController extends Controller
{
    public function index()
    {
        if (hasPermission('QuranWordWithTesting_read')) {
            // Fetch 10 records per page
            $data = QuranWordWithTesting::paginate(10);
            return view("AdminPanel.QuranWordWithTesting.index", $data);
        } else {
            abort(403);
        }
    }
    
   
     
    


    public function read()
    {
        try {
            if (hasPermission('QuranWordWithTesting_read')) {
                $length = request()->input('length', 10);
                $start = request()->input('start', 0);
                
                // Paginate the records
                $lessons = QuranWordWithTesting::offset($start)
                    ->limit($length)
                    ->get();
                
                $total = QuranWordWithTesting::count(); // Total number of records
    
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
            if (hasPermission('QuranWordWithTesting_write')) {
                if ($request->id == "") {
                    $Guaideness = new QuranWordWithTesting();
                    $Guaideness->option_1 = $request->option_1;
                    $Guaideness->option_2 = $request->option_2;
                    $Guaideness->Quran_id = $request->Quran_id;
                    
                    
                    $Guaideness->audios_link = $request->audios_link;
                  

                    $Guaideness->save();
                } else {
                    $Guaideness = QuranWordWithTesting::find($request->id);
                    $Guaideness->option_1 = $request->option_1;
                    $Guaideness->option_2 = $request->option_2;
                    $Guaideness->Quran_id = $request->Quran_id;
                    
                    
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
  
    public function readById(QuranWordWithTesting $guaideness, $id)
    {
        try {
            if (hasPermission('QuranWordWithTesting_read')) {
                $data = QuranWordWithTesting::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }
    public function destroy(QuranWordWithTesting $guaideness, $id)
    {
        $data = QuranWordWithTesting::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
