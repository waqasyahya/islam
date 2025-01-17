<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileQariSahib;

class ProfileAppQariSahibController extends Controller
{


    public function qariProfileApp(Request $request){
        $data['data'] = ProfileQariSahib::all(); 
        foreach ($data['data'] as $profile) {
            $profile->image = asset('/BlogImage/' . $profile->image);
        }
       
 return response()->json([
        'data' => $data,
    ]);
    
    }



    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'language[]' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'rate' => 'nullable|numeric',
           'experience' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female,other',
            'location' => 'nullable|string|max:255',
            'about' => 'nullable|string|max:1000',
        ]);
    
        $qariProfile = new ProfileQariSahib();
        if($request->hasFile('image')){
            $file =$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = $request->product_name.'.'.$extension;
            $file->move('BlogImage',$filename);
            $qariProfile->image =$filename;
        }
        $qariProfile->name = $request->name;
        $languagesString = implode('/ ', $request->language);
        $qariProfile->language = $languagesString;
        $qariProfile->phone_number = $request->phone_number;
        $qariProfile->email = $request->email;
        $qariProfile->rate = $request->rate;
        $qariProfile->gender = $request->gender;
        $qariProfile->location = $request->location;
          $qariProfile->experience = $request->experience;
        $qariProfile->about = $request->about;
       
        $qariProfile->save();
        return response()->json(['message' => 'Qari profile successfully'], 201);
    }



    public function updateApp(Request $request, $id)
{
    // Find the qariProfile by ID
    $qariProfile = ProfileQariSahib::find($id);

    // If qariProfile doesn't exist, return error response
    if (!$qariProfile) {
        return response()->json(['message' => 'Qari Profile not found'], 404);
    }

    // Validate the request data
    $request->validate([
        // 'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'nullable|string|max:255',
        'language[]' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:15',
        'email' => 'nullable|email|max:255',
        'rate' => 'nullable|numeric',
        'experience' => 'nullable|string|max:255',
        'gender' => 'nullable|string|in:male,female,other',
        'location' => 'nullable|string|max:255',
        'about' => 'nullable|string|max:1000',
    ]);

   
    if($request->hasFile('image')){
        $file =$request->file('image');
        $extension =$file->getClientOriginalExtension();
        $filename = $request->product_name.'.'.$extension;
        $file->move('BlogImage',$filename);
        $qariProfile->image =$filename;
    }

    // Update other fields if provided
    if ($request->filled('name')) {
        $qariProfile->name = $request->name;
    }
    if ($request->filled('language')) {
        // Use implode to concatenate the array elements into a string
        $languagesString = implode('/ ', $request->language);
        $qariProfile->language = $languagesString;
    }
    if ($request->filled('phone_number')) {
        $qariProfile->phone_number = $request->phone_number;
    }
    if ($request->filled('email')) {
        $qariProfile->email = $request->email;
    }
    if ($request->filled('rate')) {
        $qariProfile->rate = $request->rate;
    }
    if ($request->filled('gender')) {
        $qariProfile->gender = $request->gender;
    }
    if ($request->filled('location')) {
        $qariProfile->location = $request->location;
    }
    if ($request->filled('experience')) {
        $qariProfile->experience = $request->experience;
    }
    if ($request->filled('about')) {
        $qariProfile->about = $request->about;
    }

    // Save the updated qariProfile data
    $qariProfile->save();

    return response()->json(['message' => 'Qari Profile updated successfully', 'qariProfile' => $qariProfile]);
}








    
}
