<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TestmonialApp;
use Illuminate\Http\Request;

class TestmonialAppController extends Controller
{
    public function testimonials(Request $request)
    {
        $qariProfile = new TestmonialApp();
    
        if($request->hasFile('image')){
            $file =$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = $request->product_name.'.'.$extension;
            $file->move('BlogImage',$filename);
            $qariProfile->image =$filename;
        }  
        $qariProfile->name = $request->name;
        $qariProfile->testimonial = $request->testimonial;
        $qariProfile->designation = $request->designation;
        $qariProfile->save();
        return response()->json(['message' => 'Data saved successfully']);
    }


    public function tesmonialfile(Request $request){
        $data['data'] = TestmonialApp::all(); 
        foreach ($data['data'] as $profile) {
           $profile->testimonial_image = asset('BlogImage/' . $profile->image);
        }
 return response()->json([
        'data' => $data,
    ]);
    }
}
