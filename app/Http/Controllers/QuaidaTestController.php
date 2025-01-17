<?php

namespace App\Http\Controllers;

use App\Models\QuaidaTest;
use Illuminate\Http\Request;

class QuaidaTestController extends Controller
{
    // public function index()
    // {
    //     if (hasPermission('QuaidaTest_read')) {



    //         return view("AdminPanel.QuaidaTest.index");
    //     } else {
    //         abort(403);
    //     }
    // }

    public function index()
    {
        if (hasPermission('QuaidaTest_read')) {
            // Fetch 10 records per page
            $data = QuaidaTest::paginate(10);
            return view("AdminPanel.QuaidaTest.index", $data);
        } else {
            abort(403);
        }
    }


    // public function read()
    // {
    //     try {
    //         if (hasPermission('QuaidaTest_read')) {
    //             $testing = QuaidaTest::get();
    //             $json_data["data"] = $testing;
    //             return json_encode($json_data);
    //         } else {
    //             throw new \Exception("Unauthorized");
    //         }
    //     } catch (\Exception $e) {
    //         return custom_exception($e);
    //     }


    // }


    public function read()
    {
        try {
            if (hasPermission('QuaidaTest_read')) {
                $length = request()->input('length', 10);
                $start = request()->input('start', 0);
                
                // Paginate the records
                $lessons = QuaidaTest::offset($start)
                    ->limit($length)
                    ->get();
                
                $total = QuaidaTest::count(); // Total number of records
    
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
        // return $request;
        try {
            if (hasPermission('QuaidaTest_write')) {
                if ($request->id == "") {
                    // id,title,description,price,address,phone,email,whatsapp,category_id,purpose_id,rent_period_id,location_id,status
                    $testing = new QuaidaTest();
                    
                    
                 
                    
                    if ($request->hasFile('audio1')) {

                        $audio1File = $request->file('audio1');
                        $audio1Extension = $audio1File->getClientOriginalExtension();
                        $audio1Filename = time() . 'audio1' . $audio1Extension;

                        // Move the uploaded audio1 file to the appropriate directory
                        $audio1File->move('audiofolder', $audio1Filename);

                        // Set the 'audio1' attribute of the model to the saved filename
                        $testing->audio1 = $audio1Filename;
                    }
                    $testing->option_1 = $request->input('option_1');
                    $testing->option_2 = $request->input('option_2');
                    $testing->Quaida_id = $request->input('Quaida_id');

                    $testing->save();
                } else {
                    $testing = QuaidaTest::find($request->id);
                   
                  
                    if ($request->hasFile('audio1')) {
                        $audio1File = $request->file('audio1');
                        $audio1Extension = $audio1File->getClientOriginalExtension();
                        $audio1Filename = time() . 'audio1' . $audio1Extension;

                        // Move the uploaded audio1 file to the appropriate directory
                        $audio1File->move('audiofolder', $audio1Filename);

                        // Set the 'audio1' attribute of the model to the saved filename
                        $testing->audio1 = $audio1Filename;
                    }
                    $testing->option_1 = $request->input('option_1');
                    $testing->option_2 = $request->input('option_2');
                    $testing->Quaida_id = $request->input('Quaida_id');
                    $testing->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }
    }

    public function readById(QuaidaTest $Testing, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = QuaidaTest::find($id);
                return response()->json($data);
            // } else {
                // throw new \Exception("Unauthorized");
            // }
        } catch (\Exception $e) {
            return custom_exception($e);
        }

    }
    public function destroy(QuaidaTest $practic, $id)
    {
        // return $id;
        $practic = QuaidaTest::find($id);
        $practic->delete();
        return response()->json(["status" => "400"]);
    }

}
