<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ProfileQariSahib;
use App\Models\About;
use App\Models\AdminPost;
use App\Models\AdminBlog;
use Illuminate\Http\Request;
use App\Models\Islameapp;
use App\Models\QuaidaDetail;
use App\Models\Quran;
use App\Models\Quaida;
use App\Models\QuranWithAyat;


use Illuminate\Support\Facades\Cookie;

class HomeScreenController extends Controller
{


  
    public function islame()
    {
        $data = Islameapp::get();
        $totalItems = $data->count();
        
        // Determine which ID to show based on the current time
        $currentTime = Carbon::now();
        $minutes = $currentTime->diffInMinutes(Carbon::createFromTime(0, 0));
        $idToShow = ($minutes / 5) % $totalItems + 1;

        $data = $data->where('id', $idToShow)->first();

        return view('HomeScreen.Islame', compact('data'));
    }


    // public function islame()
    // {
    //     $data = Islameapp::get();
    //     $totalDays = $data->count();
        
    //     // Determine which ID to show based on the current date
    //     $currentDate = Carbon::now();
    //     $dayOfMonth = $currentDate->day; // 1 to 31
    //     $idToShow = ($dayOfMonth % $totalDays) + 1;

    //     $data = $data->where('id', $idToShow)->first();

    //     return view('HomeScreen.Islame', compact('data'));
    // }




    public function islamepage(){

        return view('HomeScreen.Islame');
    }


    public function aboutpage() {

        $data =  About::all();

return view('HomeScreen.About', compact('data'));

    }
  
    public function featurepage(){
        return view('HomeScreen.Features');
    }


    public function learnepage(){
        return view('HomeScreen.Learn');
    }
    public function servicspage(){
        return view('HomeScreen.servics');
    }


        public function blogpage() {

        $data =  AdminBlog::get();

return view('HomeScreen.Blog', compact('data'));

    }

     public function post($id) {
        $data['data'] = AdminPost::where('blogpage_id', $id)->get();

        return view('HomeScreen.Post', $data);
    }


    public function qariProfile(Request $request){
        $data['data'] = ProfileQariSahib::all(); 
        foreach ($data['data'] as $profile) {
            $profile->profile_image = asset('public/profile_images/' . $profile->profile_image);
        }
   
        return view('HomeScreen.qaripage', $data);
    }
    public function DetailQari($id) {
        $data['data'] = ProfileQariSahib::where('id', $id)->get();
    
        return view('HomeScreen.detailprofile', $data);
    }

    public function storeApp(Request $request)
    {
        $qariProfile = new ProfileQariSahib();

        // Check if the request has a file and it's an image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->product_name . '.' . $extension;

            // Move the file to the public storage path
            $file->move(public_path('BlogImage'), $filename);
            $qariProfile->image = $filename;
        }

        // Assign other properties
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

        // Save the profile
        $qariProfile->save();

        // Redirect to the profile route
        return redirect()->route('qariProfile');
    }

    
    public function setCookie(Request $request, $theme)
    {
        $cookie = cookie('theme', $theme, 60 * 24 * 30); // Cookie named 'theme' with selected theme for 30 days
        return response()->json(['message' => 'Cookie has been set.'])->cookie($cookie);
    }

    public function deleteCookie(Request $request)
    {
        $cookie = Cookie::forget('banner_cookie');
        return response()->json(['message' => 'Cookie has been deleted.'])->cookie($cookie);
    }







    public function getVisitsData()
    {
        $visits = DB::table('visitors')
            ->select(
                DB::raw('DATE(visited_at) as date'),
                DB::raw('count(*) as visits'),
                'country',
                'city',
                'region',
                'latitude',
                'longitude'
            )
            ->where('visited_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date', 'country', 'city', 'region', 'latitude', 'longitude')
            ->orderBy('date', 'asc')
            ->get();
    
        return response()->json($visits);
    }



    public function getProgressData()
    {
        $totalVisits = DB::table('visitors')
            ->whereDate('visited_at', Carbon::today())
            ->count();
    
        $visits = DB::table('visitors')
            ->select(DB::raw('DATE(visited_at) as date'), DB::raw('count(*) as visits'))
            ->where('visited_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function($visit) use ($totalVisits) {
                $visit->percentage = $totalVisits > 0 ? round(($visit->visits / $totalVisits) * 100, 2) : 0;
                return $visit;
            });

        return response()->json($visits);
    }








    public function QuaidaDetailApp($quaida_id, Request $request)
    {
        // Get the specific id from the request, or use the first record if id is not provided
        $id = $request->query('id');

        // Fetch the first record for the given Quaida_id if no ID is provided
        if (!$id) {
            $firstRecord = QuaidaDetail::where('Quaida_id', $quaida_id)
                                        ->orderBy('id', 'asc')
                                        ->first();
            $id = $firstRecord ? $firstRecord->id : null;
        }

        // Fetch the data for the given Quaida_id and specific id
        $data = QuaidaDetail::where('Quaida_id', $quaida_id)
                            ->where('id', $id)
                            ->first();

        if ($data) {
            $data->audio1 = asset('/Quranfolder/' . $data->audio1);
            $data->file_type = pathinfo(public_path('Quranfolder/' . $data->audio1), PATHINFO_EXTENSION);
        }

        // Find next and previous IDs within the same Quaida_id
        $nextId = QuaidaDetail::where('Quaida_id', $quaida_id)
                              ->where('id', '>', $id)
                              ->orderBy('id', 'asc')
                              ->min('id');

        $prevId = QuaidaDetail::where('Quaida_id', $quaida_id)
                              ->where('id', '<', $id)
                              ->orderBy('id', 'desc')
                              ->max('id');

        // Return a Blade view with the data, nextId, and prevId
        return view('HomeScreen.DetailQuaida', [
            'data' => $data,
            'nextId' => $nextId,
            'prevId' => $prevId
        ]);
    }





    public function QuranApp(){
        $data = Quran::all();
        return view('HomeScreen.Quran', ['data' => $data]);


    }


    public function QuaidaApp(){
        $data = Quaida::all();
        return view('HomeScreen.Quaida', ['data' => $data]);


    }





    public function QuranDetailApp($quran_id, Request $request)
    {
        // Get the specific id from the request, or use the first record if id is not provided
        $id = $request->query('id');

        // Fetch the first record for the given Quaida_id if no ID is provided
        if (!$id) {
            $firstRecord = QuranWithAyat::where('Quran_id', $quran_id)
                                        ->orderBy('id', 'asc')
                                        ->first();
            $id = $firstRecord ? $firstRecord->id : null;
        }

        // Fetch the data for the given Quaida_id and specific id
        $data = QuranWithAyat::where('Quran_id', $quran_id)
                            ->where('id', $id)
                            ->first();

        // if ($data) {
        //     $data->audio1 = asset('/Quranfolder/' . $data->audio1);
        //     $data->file_type = pathinfo(public_path('Quranfolder/' . $data->audio1), PATHINFO_EXTENSION);
        // }

        // Find next and previous IDs within the same Quaida_id
        $nextId = QuranWithAyat::where('Quran_id', $quran_id)
                              ->where('id', '>', $id)
                              ->orderBy('id', 'asc')
                              ->min('id');

        $prevId = QuranWithAyat::where('Quran_id', $quran_id)
                              ->where('id', '<', $id)
                              ->orderBy('id', 'desc')
                              ->max('id');

        // Return a Blade view with the data, nextId, and prevId
        return view('HomeScreen.QuranAyat', [
            'data' => $data,
            'nextId' => $nextId,
            'prevId' => $prevId
        ]);
    }


}
