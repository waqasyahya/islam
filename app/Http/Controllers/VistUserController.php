<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VistUserController extends Controller
{
    public function index()
    {
        if (hasPermission('Visitor_read')) {
            $data = Visitor::all();
            return view("AdminPanel.VistUser.index", $data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try {
            if (hasPermission('Visitor_read')) {
                $lesson = Visitor::get();
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
            if (hasPermission('Visitor_write')) {
                if ($request->id == "") {
                    $lesson = new Visitor();
                    $lesson->country = $request->country;
                    $lesson->city = $request->city;
                    $lesson->region = $request->region;
                    $lesson->latitude = $request->latitude;
                    $lesson->longitude = $request->longitude;
                    $lesson->ip_address = $request->ip_address;
                    $lesson->visited_at = $request->visited_at;
                   
                 
                    $lesson->save();
                } else {
                    $lesson = Visitor::find($request->id);
                    $lesson->country = $request->country;
                    $lesson->city = $request->city;
                    $lesson->region = $request->region;
                    $lesson->latitude = $request->latitude;
                    $lesson->longitude = $request->longitude;
                    $lesson->ip_address = $request->ip_address;
                    $lesson->visited_at = $request->visited_at;
                 
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

    public function readById(Visitor $read, $id)
    {
        try {
            if (hasPermission('Visitor_read')) {
                $data = Visitor::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }






    public function destroy(Visitor $lesson, $id)
    {
        $data = Visitor::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
