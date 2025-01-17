<?php

namespace App\Http\Controllers;

use App\Models\QuaidaDetail;
use Illuminate\Http\Request;

class QuaidaDetailController extends Controller
{


    public function index()
    {
        if (hasPermission('QuaidaDetail_read')) {
            // Fetch 10 records per page
            $data = QuaidaDetail::paginate(10);
            return view("AdminPanel.QuaidaDetail.index", $data);
        } else {
            abort(403);
        }
    }



















  

    // public function read()
    // {
    //     try {
    //         if (hasPermission('QuaidaDetail_read')) {
    //             $lessons = QuaidaDetail::paginate(10); // Fetch 10 records per page
    //             return response()->json([
    //                 'data' => $lessons->items(),
    //                 'recordsTotal' => $lessons->total(),
    //                 'recordsFiltered' => $lessons->total(),
    //             ]);
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
            if (hasPermission('QuaidaDetail_read')) {
                $length = request()->input('length', 10);
                $start = request()->input('start', 0);
                
                // Paginate the records
                $lessons = QuaidaDetail::offset($start)
                    ->limit($length)
                    ->get();
                
                $total = QuaidaDetail::count(); // Total number of records
    
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
            if (hasPermission('QuaidaDetail_write')) {
                if ($request->id == "") {
                    // id,title,description,price,address,phone,email,whatsapp,category_id,purpose_id,rent_period_id,location_id,status
                    $practic = new QuaidaDetail();
                
                    if ($request->hasFile('audio1')) {

                        $audio1File = $request->file('audio1');
                        $audio1Extension = $audio1File->getClientOriginalExtension();
                        $audio1Filename = time() . 'audio1' . $audio1Extension;
                        $audio1File->move('Quranfolder', $audio1Filename);
                        $practic->audio1 = $audio1Filename;
                    }
                    $practic->Quaida_id = $request->input('Quaida_id');
                    $practic->WordsArabic= $request->input('WordsArabic');
                    $practic->Words_id= $request->input('Words_id');
                    $practic->Words_Urdu= $request->input('Words_Urdu');
                 
                

                    $practic->save();
                } else {
                    $practic = QuaidaDetail::find($request->id);
                  


                    if ($request->hasFile('audio1')) {
                        $audio1File = $request->file('audio1');
                        $audio1Extension = $audio1File->getClientOriginalExtension();
                        $audio1Filename = time() . 'audio1' . $audio1Extension;

                        $audio1File->move('Quranfolder', $audio1Filename);

                        $practic->audio1 = $audio1Filename;
                    }
                    $practic->Quaida_id = $request->input('Quaida_id');
                    $practic->Words_Arabic= $request->input('Words_Arabic');
                    $practic->Words_id= $request->input('Words_id');
                    $practic->Words_Urdu= $request->input('Words_Urdu');
                






                    $practic->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }
    }
    public function readById(QuaidaDetail $QuaidaDetail, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = QuaidaDetail::find($id);
                return response()->json($data);
            // } else {
                // throw new \Exception("Unauthorized");
            // }
        } catch (\Exception $e) {
            return custom_exception($e);
        }

    }
    public function destroy(QuaidaDetail $QuaidaDetail, $id)
    {
        // return $id;
        $practic = QuaidaDetail::find($id);
        $practic->delete();
        return response()->json(["status" => "400"]);
    }
}
