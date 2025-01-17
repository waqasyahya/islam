<?php

namespace App\Http\Controllers;

use App\Models\ProfileQariSahib;
use Illuminate\Http\Request;

class ProfileQariSahibController extends Controller
{
    public function index()
    {
        if (hasPermission('ProfileQariSahib_read')) {
          

            return view("AdminPanel.ProfileQariSahib.index");
        } else {
            abort(403);
        }
    }







    public function read()
    {
        try {
            if (hasPermission('ProfileQariSahib_read')) {
                $blogpage = ProfileQariSahib::get();
                $json_data["data"] = $blogpage;
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
            if (hasPermission('ProfileQariSahib_write')) {
                if ($request->id == "") {

                    $blogpage = new ProfileQariSahib;
                    $blogpage->name = $request->name;
                    $blogpage->language = $request->language;
                    $blogpage->phone_number = $request->phone_number;
                    $blogpage->	email = $request->email;
                    $blogpage->rate = $request->rate;
                    $blogpage->gender = $request->gender;
                    $blogpage->	location = $request->location;
                    $blogpage->	experience = $request->	experience;
                    $blogpage->about = $request->about;
                     if($request->hasFile('image')){
                         $file =$request->file('image');
                         $extension =$file->getClientOriginalExtension();
                         $filename = $request->product_name.'.'.$extension;
                         $file->move('BlogImage',$filename);
                         $blogpage->image =$filename;
                     }



                    $blogpage->save();
                } else {
                    $blogpage = ProfileQariSahib::find($request->id);
                    $blogpage->name = $request->name;
                    $blogpage->language = $request->language;
                    $blogpage->phone_number = $request->phone_number;
                    $blogpage->	email = $request->email;
                    $blogpage->rate = $request->rate;
                    $blogpage->gender = $request->gender;
                    $blogpage->	location = $request->location;
                    $blogpage->	experience = $request->	experience;
                    $blogpage->about = $request->about;
                    if($request->hasFile('image')){
                        $file =$request->file('image');
                        $extension =$file->getClientOriginalExtension();
                        $filename = $request->product_name.'.'.$extension;
                        $file->move('BlogImage',$filename);
                        $blogpage->image =$filename;
                    }
                    $blogpage->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }



    }
    public function readById(ProfileQariSahib $property, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = ProfileQariSahib::find($id);
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
    public function destroy(ProfileQariSahib $property, $id)
    {
        // return $id;
        $blogpage = ProfileQariSahib::find($id);
        $blogpage->delete();
        return response()->json(["status" => "400"]);
    }
}
