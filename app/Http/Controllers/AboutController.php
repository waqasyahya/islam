<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        if (hasPermission('about_read')) {
          

            return view("AdminPanel.About.index");
        } else {
            abort(403);
        }
    }

   






    public function read()
    {
        try {
            if (hasPermission('about_read')) {
                $about = About::get();
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
        // return $request;
        try {
            if (hasPermission('about_write')) {
                if ($request->id == "") {

                    $about = new About;
                 
                    $about->Heading = $request->Heading;
                    $about->detailpara = $request->detailpara;
                     if($request->hasFile('image')){
                         $file =$request->file('image');
                         $extension =$file->getClientOriginalExtension();
                         $filename = $request->product_name.'.'.$extension;
                         $file->move('image',$filename);
                         $about->image =$filename;
                     }



                    $about->save();
                } else {
                    $about = About::find($request->id);
                 
                    $about->Heading = $request->Heading;
                    $about->detailpara = $request->detailpara;
                    if ($request->hasFile('image')) {
                        $File = $request->file('image');
                        $imageExtension = $File->getClientOriginalExtension();
                        $imageFilename = time() . '.' . $imageExtension;
                        $File->move('image', $imageFilename);
                        $about->image = $imageFilename;
                    }
                    $about->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }



    }
    public function readById(About $about, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = About::find($id);
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
    public function destroy(About $about, $id)
    {
        // return $id;
        $blogpage = About::find($id);
        $blogpage->delete();
        return response()->json(["status" => "400"]);
    }


   
   
}
