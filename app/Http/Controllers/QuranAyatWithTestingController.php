<?php

namespace App\Http\Controllers;

use App\Models\QuranAyatWithTesting;
use Illuminate\Http\Request;

class QuranAyatWithTestingController extends Controller
{
    public function index()
    {
        if (hasPermission('QuranAyatWithTesting_read')) {



            return view("AdminPanel.QuranAyatWithTesting.index");
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try {
            if (hasPermission('QuranAyatWithTesting_read')) {
                $testing = QuranAyatWithTesting::get();
                $json_data["data"] = $testing;
                return json_encode($json_data);
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
            if (hasPermission('QuranAyatWithTesting_write')) {
                if ($request->id == "") {
               
                    $testing = new QuranAyatWithTesting();
                    $testing->Quran_id = $request->input('Quran_id');
                    $testing->option_1 = $request->input('option_1');
                    $testing->option_2 = $request->input('option_2');
                    
                    // if ($request->hasFile('audio1')) {

                    //     $audio1File = $request->file('audio1');
                    //     $audio1Extension = $audio1File->getClientOriginalExtension();
                    //     $audio1Filename = time() . 'audio1' . $audio1Extension;

                     
                    //     $audio1File->move('audiofolder', $audio1Filename);

                   
                    //     $testing->audio1 = $audio1Filename;
                    // }
                  

                    $testing->save();
                } else {
                    $testing = QuranAyatWithTesting::find($request->id);
                    $testing->Quran_id = $request->input('Quran_id');
                    $testing->option_1 = $request->input('option_1');
                    $testing->option_2 = $request->input('option_2');
                     

                    // if ($request->hasFile('audio1')) {
                    //     $audio1File = $request->file('audio1');
                    //     $audio1Extension = $audio1File->getClientOriginalExtension();
                    //     $audio1Filename = time() . 'audio1' . $audio1Extension;

                      
                    //     $audio1File->move('audiofolder', $audio1Filename);

                   
                    //     $testing->audio1 = $audio1Filename;
                    // }
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

    public function readById(QuranAyatWithTesting $Testing, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = QuranAyatWithTesting::find($id);
                return response()->json($data);
            // } else {
                // throw new \Exception("Unauthorized");
            // }
        } catch (\Exception $e) {
            return custom_exception($e);
        }

    }
    public function destroy(QuranAyatWithTesting $Testing, $id)
    {
        // return $id;
        $practic = QuranAyatWithTesting::find($id);
        $practic->delete();
        return response()->json(["status" => "400"]);
    }
}
