<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AppRegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Islameapp;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Illuminate\Support\Facades\Mail;

class UserAppController extends Controller
{


    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required_without:phone|email', // Require email if phone is not provided
            'phone' => 'required_without:email|string|digits:11', // Require phone if email is not provided, exactly 11 digits
            'password' => 'required|string|min:6',
        ]);

        addLApiChecked('Registration attempt started', [
            'endpoint' => request()->fullUrl(),
        'method' => request()->method(),
        'request_data' => $request->all(),
        ]);
    

        // Initialize variables to check if user already exists
        $userExists = false;
        $existingUser = null;
        $userExists = User::where('phone', $request->phone)->first();
        // Check if email is provided and if it matches any existing user
        if ($request->has('email')) {
            $existingUser = User::where('email', $request->email)->first();
            $userExists = $existingUser ? true : false;
        }

        // If email is not provided or if provided email does not match any existing user, check phone number
        if (!$userExists && $request->has('phone')) {
            $existingUser = User::where('phone', $request->phone)->first();
            $userExists = $existingUser ? true : false;
        }

        // If user already exists, check if the provided password matches
        if ($userExists && !Hash::check($request->password, $existingUser->password)) {
            return response()->json(['message' => 'User already registered'], 400);
        }

        // Create the user if validation passes and user doesn't exist or if password matches
        if (!$userExists) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            addLApiChecked('User registered successfully', [
                'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            ]);
        
           
            Mail::to($user->email)->send(new AppRegisterEmail($user));

            // Return success response
            return response()->json(['message' => 'User registered successfully', 'user' => $user, 'status' => 'Success']);
        }

        // If user exists, return error response
        return response()->json(['message' => 'User already registered'], 400);
    }



    public function forgotPassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required_without:phone|email', // Email required if phone is not provided
            'phone' => 'required_without:email|string|digits:11', // Phone required if email is not provided
            'new_password' => 'required|string|min:6|confirmed', // Ensure new password is confirmed
            // 'new_password_confirmation' => 'required|string|min:6|confirmed',
        ]);

        // Check for the user based on email or phone
        $user = null;

        if ($request->has('email')) {
            $user = User::where('email', $request->email)->first();
        }

        if (!$user && $request->has('phone')) {
            $user = User::where('phone', $request->phone)->first();
        }

        // If the user doesn't exist, return an error
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Log password reset success
       
        addLApiChecked('Password Reset', [
            'user_id' => $user->id,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => 'Success',
        ]);
    

        // Optionally, send an email to notify the user
        if ($user->email) {
            Mail::to($user->email)->send(new AppRegisterEmail($user));
        }

        // Return a success response
        return response()->json(['message' => 'Password reset successfully', 'status' => 'Success']);
    }



    public function retrieveEmail(Request $request)
    {
        // Validate the input: either email or phone must be provided
        $request->validate([
            'email' => 'required_without:phone|email', // Email is required if phone is not provided
            'phone' => 'required_without:email|string|digits:11', // Phone is required if email is not provided, must be 11 digits
        ]);

        // Check if email is provided
        if ($request->has('email')) {
            $user = User::where('email', $request->email)->first();

            // If no user is found, return an error
            if (!$user) {
                return response()->json(['message' => 'Email not found in our records'], 404);
            }

            // Log contact retrieval success
          
            addLApiChecked('email  recoverd', [
               'user_id' => $user->id,
                'email' => $user->email,

                'status' => 'successfully',
            ]);

            // Return the phone number associated with the email
            return response()->json([
                'message' => 'Phone number retrieved successfully',
                'phone' => $user->phone,
            ], 200);
        }

        // Check if phone is provided
        if ($request->has('phone')) {
            $user = User::where('phone', $request->phone)->first();

            // If no user is found, return an error
            if (!$user) {
                return response()->json(['message' => 'Phone number not found in our records'], 404);
            }

            // Log contact retrieval success
           
            addLApiChecked('email recoverd ', [
                'user_id' => $user->id,
                 'phone' => $user->phone,
 
                 'status' => 'successfully',
             ]);
 
            

            // Return the email associated with the phone number
            return response()->json([
                'message' => 'Email retrieved successfully',
                'email' => $user->email,
            ], 200);
        }
    }
































    public function login(Request $request)
    {
        $request->validate([
            'field' => 'required', // 'credential' field will hold either email or phone
            'password' => 'required|string'
        ]);

        $credentials = $request->only('field', 'password');
        addLApiChecked('Login attempt started', [
            'endpoint' => request()->fullUrl(),
        'method' => request()->method(),
        'request_data' => $request->all(),
        ]);

        $user = User::where('email', $credentials['field'])
                     ->orWhere('phone', $credentials['field'])
                     ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid field'], 401);


        }

        Auth::login($user);
        addLApiChecked('User login successfully', [
            'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        ]);
      
    

        return response()->json(['message' => 'Login successful', 'user' => $user]);
    }
    


        
    public function updateApp(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,'.$id, // Unique email except for the current user
            'phone' => 'nullable|string|unique:users,phone,'.$id, // Unique phone except for the current user
            'password' => 'nullable|string|min:6',
        ]);

        // Find the user by ID
        $user = User::find($id);

        // If user doesn't exist, return error response
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's fields if provided
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user data
        $user->save();

        // Prepare the user data for response (excluding password hash)
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];

        // Log the update
        addLApiChecked('User Update Successful', [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => 'Success',
        ]);

        // Return success response
        return response()->json(['message' => 'User updated successfully', 'user' => $userData]);
    }

    
    
    
    public function logout(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);
    
        // If user doesn't exist, return error response
        if (!$user)
        {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Revoke all tokens issued to the user
        $user->tokens()->delete();
    
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function deleteUserById(Request $request)
    {
        // Validate the input: user ID must be provided and numeric
        $request->validate([
            'id' => 'required|integer|exists:users,id', // Ensure the ID exists in the 'users' table
        ]);

        // Fetch the user by ID
        $user = User::find($request->id);

        // If the user doesn't exist (unlikely due to validation), return an error
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Log user account deletion
        addLApiChecked('User Account Deletion', [
            'user_id' => $user->id,
            'status' => 'Deleted',
        ]);

        // Delete the user
        $user->delete();

        // Return success response
        return response()->json([
            'message' => 'User account deleted successfully',
        ], 200);
    }

    
    
    public function islameapp()
    {
        $data = Islameapp::get();
        $totalItems = $data->count();
        
        // Determine which ID to show based on the current time
        $currentTime = Carbon::now();
        $minutes = $currentTime->diffInMinutes(Carbon::createFromTime(0, 0));
        $idToShow = ($minutes / 5) % $totalItems + 1;

        $data = $data->where('id', $idToShow)->first();

        return response()->json( $data);
    }

    
    
      
}
