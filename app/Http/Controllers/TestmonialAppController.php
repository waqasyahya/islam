<?php

namespace App\Http\Controllers;

use App\Models\TestmonialApp;
use Illuminate\Http\Request;

class TestmonialAppController extends Controller
{
    
    public function index()
    {
        if (hasPermission('TestmonialApp_read')) {
          

            return view("AdminPanel.TestmonialApp.index");
        } else {
            abort(403);
        }
    }







    public function read()
    {
        try {
            if (hasPermission('TestmonialApp_read')) {
                $blogpage = TestmonialApp::get();
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
            if (hasPermission('TestmonialApp_write')) {
                if ($request->id == "") {

                    $blogpage = new TestmonialApp;
                    $blogpage->name = $request->name;
                    $blogpage->testimonial = $request->testimonial;
                    $blogpage->designation = $request->designation;
                     if($request->hasFile('image')){
                         $file =$request->file('image');
                         $extension =$file->getClientOriginalExtension();
                         $filename = $request->product_name.'.'.$extension;
                         $file->move('BlogImage',$filename);
                         $blogpage->image =$filename;
                     }



                    $blogpage->save();
                } else {
                    $blogpage = TestmonialApp::find($request->id);
                    $blogpage->name = $request->name;
                    $blogpage->testimonial = $request->testimonial;
                    $blogpage->designation = $request->designation;
                    if ($request->hasFile('image')) {
                        $File = $request->file('image');
                        $imageExtension = $File->getClientOriginalExtension();
                        $imageFilename = time() . '.' . $imageExtension;
                        $File->move('BlogImage', $imageFilename);
                        $blogpage->image = $imageFilename;
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
    public function readById(TestmonialApp $property, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = TestmonialApp::find($id);
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
    public function destroy(TestmonialApp $property, $id)
    {
        // return $id;
        $blogpage = TestmonialApp::find($id);
        $blogpage->delete();
        return response()->json(["status" => "400"]);
    }
}
