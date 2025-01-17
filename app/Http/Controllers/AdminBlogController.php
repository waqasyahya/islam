<?php

namespace App\Http\Controllers;

use App\Models\AdminBlog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        if (hasPermission('AdminBlog_read')) {
          

            return view("AdminPanel.AdminBlog.index");
        } else {
            abort(403);
        }
    }







    public function read()
    {
        try {
            if (hasPermission('AdminBlog_read')) {
                $blogpage = AdminBlog::get();
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
            if (hasPermission('AdminBlog_write')) {
                if ($request->id == "") {

                    $blogpage = new AdminBlog;
                    $blogpage->tittle = $request->tittle;
                    $blogpage->Description = $request->Description;
                    $blogpage->underdecsription = $request->underdecsription;
                     if($request->hasFile('image')){
                         $file =$request->file('image');
                         $extension =$file->getClientOriginalExtension();
                         $filename = $request->product_name.'.'.$extension;
                         $file->move('BlogImage',$filename);
                         $blogpage->image =$filename;
                     }



                    $blogpage->save();
                } else {
                    $blogpage = AdminBlog::find($request->id);
                    $blogpage->tittle = $request->tittle;
                    $blogpage->Description = $request->Description;
                    $blogpage->underdecsription = $request->underdecsription;
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
    public function readById(AdminBlog $property, $id)
    {
        try {
            // if (hasPermission('property_read')) {
                $data = AdminBlog::find($id);
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
    public function destroy(AdminBlog $property, $id)
    {
        // return $id;
        $blogpage = AdminBlog::find($id);
        $blogpage->delete();
        return response()->json(["status" => "400"]);
    }
}
