<?php

namespace App\Http\Controllers;

use App\Models\ContactMe;
use Illuminate\Http\Request;

class ContactMeController extends Controller
{

    public function storeapp(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'Subject' => 'required|string|max:255',
            'Message' => 'required|string',
        ]);
    
        ContactMe::create($validated);
    
        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    }




    public function index()
    {
        if (hasPermission('ContactMe_read')) {
            $data = ContactMe::all();
            return view("AdminPanel.ContactMe.index", $data);
        } else {
            abort(403);
        }
    }
    public function read()
    {
        try {
            if (hasPermission('ContactMe_read')) {
                $lesson = ContactMe::get();
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
            if (hasPermission('ContactMe_write')) {
                if ($request->id == "") {
                    $lesson = new ContactMe();
                    $lesson->name = $request->name;
                    $lesson->email = $request->email;
                    $lesson->Subject = $request->Subject;
                    $lesson->Message = $request->Message;
                 
                    $lesson->save();
                } else {
                    $lesson = ContactMe::find($request->id);
                    $lesson->name = $request->name;
                    $lesson->email = $request->email;
                    $lesson->Subject = $request->Subject;
                    $lesson->Message = $request->Message;
                 
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

    public function readById(ContactMe $read, $id)
    {
        try {
            if (hasPermission('ContactMe_read')) {
                $data = ContactMe::find($id);
                return response()->json($data);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return  custom_exception($e);
        }
    }






    public function destroy(ContactMe $lesson, $id)
    {
        $data = ContactMe::find($id);
        $data->delete();
        return response()->json(["status" => "600"]);
        //
    }
}
