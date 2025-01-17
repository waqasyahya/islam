<?php

namespace App\Http\Controllers;

use App\Models\AdminPost;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        if (hasPermission('AdminPost_read')) {
          


            return view("AdminPanel.AdminPost.index");
        } else {
            abort(403);
        }
    }

  




    public function read()
    {
        try {
            if (hasPermission('AdminPost_read')) {
                $blogpost = AdminPost::get();
                $json_data["data"] = $blogpost;
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
            if (hasPermission('AdminPost_write')) {
                if ($request->id == "") {

                    $blogpost = new AdminPost();
                    $blogpost->tittle = $request->tittle;
                    $blogpost->Description1 = $request->Description1;
                    $blogpost->Description2 = $request->Description2;
                    $blogpost->Description3 = $request->Description3;
                    $blogpost->blogpage_id = $request->blogpage_id;
                    $blogpost->meta_title = $request->meta_title;
            $blogpost->meta_keywords = $request->meta_keywords;
            $blogpost->meta_description = $request->meta_description;

                     if($request->hasFile('image')){
                         $file =$request->file('image');
                         $extension =$file->getClientOriginalExtension();
                         $filename = $request->product_name.'.'.$extension;
                         $file->move('Blogpostimage',$filename);
                         $blogpost->image =$filename;
                     }



                    $blogpost->save();
                } else {
                    $blogpost = AdminPost::find($request->id);
                    $blogpost->tittle = $request->tittle;
                    $blogpost->Description1 = $request->Description1;
                    $blogpost->Description2 = $request->Description2;
                    $blogpost->Description3 = $request->Description3;
                    $blogpost->blogpage_id = $request->blogpage_id;
                    $blogpost->meta_title = $request->meta_title;
            $blogpost->meta_keywords = $request->meta_keywords;
            $blogpost->meta_description = $request->meta_description;
                    if ($request->hasFile('image')) {
                        $File = $request->file('image');
                        $imageExtension = $File->getClientOriginalExtension();
                        $imageFilename = time() . '.' . $imageExtension;
                        $File->move('Blogpostimage', $imageFilename);
                        $blogpost->image = $imageFilename;
                    }
                    $blogpost->save();
                }
                return response()->json(["status" => "200"]);
            } else {
                throw new \Exception("Unauthorized");
            }
        } catch (\Exception $e) {
            return custom_exception($e);
        }



    }
    public function readById(AdminPost $property, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = AdminPost::find($id);
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
    public function destroy(AdminPost $property, $id)
    {
        // return $id;
        $blogpost = AdminPost::find($id);
        $blogpost->delete();
        return response()->json(["status" => "400"]);
    }
}
