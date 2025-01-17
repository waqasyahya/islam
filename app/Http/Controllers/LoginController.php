<?php
// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;
use App\Models\user;
use App\Models\login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('waqas')->only('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Fetch the user by email
        $user = user::where('email', $credentials['email'])->first();
    
        // Check if the user exists and the password is correct
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Authentication passed, redirect to the desired page
            return redirect()->route('Quaida');
        } else {
            // Invalid email or password, redirect back with an error message
            return redirect()->route('AdminPanel.login.form')->with('error', 'Invalid email or password');
        }
    }

    



public function voicecompare1(){
    return view('voicecompare');
}



public function compareAudio(Request $request)
{
    $file1 = $request->file('file1');
    $file2 = $request->file('file2');

    // Fetch the content of the Python script
    $pythonScriptUrl = 'https://srv738-files.hstgr.io/1c4fdda28fe109b0/files/Voice-Compare-Algo.py';
    $pythonScriptContent = Http::get($pythonScriptUrl)->body();

    // Check if the request to fetch the Python script was successful
    if (empty($pythonScriptContent)) {
        session()->flash('result', 'Failed to fetch Python script content');
        return redirect()->route('result');
    }

    // Attach audio files and send them to the Python script
    $response = Http::attach('file1', $file1, $file1->getClientOriginalName())
        ->attach('file2', $file2, $file2->getClientOriginalName())
        ->withHeaders([
            'Referer' => 'http://127.0.0.1:8000/compare',
            'Origin' => 'http://127.0.0.1:8000',
            'X-CSRF-Token' => csrf_token(),
        ])
        ->post('https://srv738-files.hstgr.io/1c4fdda28fe109b0/files/Voice-Compare-Algo.py/api/upload', [
            'python_script' => $pythonScriptContent,
        ]);

    // Handle the response from the Python script
    if ($response->successful()) {
        $result = $response->json();
        
        // Check if 'result' key exists in the JSON response
        if (isset($result['result'])) {
            // Flash the result to the session
            session()->flash('result', $result['result']);
        } else {
            session()->flash('result', 'Invalid response format: Missing "result" key');
        }
    } else {
        session()->flash('result', 'API request failed with status code: ' . $response->status());
    }

    return redirect()->route('result');
}



    public function showResult()
    {
        $result = session('result', 'Not Message');

        return view('result')->with('result', $result);
    }












}
