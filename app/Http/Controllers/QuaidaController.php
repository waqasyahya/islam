<?php

namespace App\Http\Controllers;

use App\Models\Quaida;
use Illuminate\Http\Request;

class QuaidaController extends Controller
{







    public function index()
    {
        if (hasPermission('Quaida_read')) {
          

            return view("AdminPanel.Quaida.index");
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try {
            if (hasPermission('Quaida_read')) {
                $about = Quaida::get();
                $json_data["data"] = $about;
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
        try {
            if (hasPermission('Quaida_write')) {
                if ($request->id == "") {

                    $quaida = new Quaida();
                 
                    $quaida->Quaida_Name = $request->Quaida_Name;
                    $quaida->Quaida_Words = $request->Quaida_Words;
                    $quaida->save();
                } else {
                    $quaida = Quaida::find($request->id);
                 
                    $quaida->Quaida_Name = $request->Quaida_Name;
                    $quaida->Quaida_Words = $request->Quaida_Words;
                  
                    $quaida->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }



    }
    public function readById(Quaida $quaida, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = Quaida::find($id);
                return response()->json($data);
            // } else {
                // throw new \Exception("Unauthorized");
            // }
        } catch (\Exception $e) {
            return custom_exception($e);
        }

    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quaida $quaida, $id)
    {
        
        $quaida = Quaida::find($id);
        $quaida->delete();
        return response()->json(["status" => "400"]);
    }
}
