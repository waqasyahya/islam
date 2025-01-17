<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Notifications\SendOTP;
use Carbon\Carbon;

class OTPController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle user registration and OTP generation
    public function otpregister(Request $request) // Renamed method to 'otpregister'
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store the OTP in the email_verifications table
        DB::table('email_verifications')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]
        );

        // Create a new user with the provided email and hashed password
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send OTP to the user's email
        $user->notify(new SendOTP($otp));

        return redirect()->route('otp.verify')->with(['email' => $request->email]);
    }

    // Show the OTP verification form
    public function showVerifyForm()
    {
        return view('auth.verify');
    }

    // Handle OTP verification
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the OTP matches and is not expired
        $record = DB::table('email_verifications')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if ($record) {
            // Mark the user's email as verified
            DB::table('users')
                ->where('email', $request->email)
                ->update(['email_verified_at' => now()]);

            // Delete the OTP record after successful verification
            DB::table('email_verifications')
                ->where('email', $request->email)
                ->delete();

            return redirect()->route('aboutpage')->with('message', 'Email verified successfully.');
        } else {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP or OTP has expired.']);
        }
    }









    public function register1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
    
        // Store the OTP in the email_verifications table
        DB::table('email_verifications')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'created_at' => Carbon::now(),  // Ensure timestamps are added
                'updated_at' => Carbon::now()
            ]
        );
    
        // Create a new user with the provided email and hashed password
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Send OTP to the user's email
        $user->notify(new SendOTP($otp));
    
        return response()->json(['message' => 'User registered successfully. Please verify your email.', 'user_id' => $user->id]);
    }
    
    // Handle OTP verification via API
    public function verify1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Check if the OTP matches and is not expired
        $record = DB::table('email_verifications')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();
    
        if ($record) {
            // Mark the user's email as verified
            DB::table('users')
                ->where('email', $request->email)
                ->update(['email_verified_at' => now()]);
    
            // Delete the OTP record after successful verification
            DB::table('email_verifications')
                ->where('email', $request->email)
                ->delete();
    
            return response()->json(['message' => 'Email verified successfully.']);
        } else {
            return response()->json(['message' => 'Invalid OTP or OTP has expired. Please try again.'], 400);
        }
    }
    
}
