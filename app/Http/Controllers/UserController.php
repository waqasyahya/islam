<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        if (hasPermission('User_read')) {
            $data = User::all();
            return view("AdminPanel.User.index", $data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try {
            if (hasPermission('User_read')) {
                $lesson = User::get();
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
            if (hasPermission('User_write')) {
                if ($request->id == "") {
                    $User = new User();
                    $User->name = $request->name;
                    $User->email = $request->email;
                    $User->phone = $request->phone;
                    $User->password = $request->password;



                    $User->save();
                } else {
                    $User = User::find($request->id);
                    $User->name = $request->name;
                    $User->email = $request->email;
                    $User->phone = $request->phone;
                    $User->password = $request->password;

                    $User->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }

    public function readById(User $User, $id)
    {
        try {
            if (hasPermission('User_read')) {
                $data = User::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }






    public function destroy(User $User, $id)
    {
        $data = User::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
