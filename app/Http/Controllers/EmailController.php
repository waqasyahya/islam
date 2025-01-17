<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMessageEmail;

class EmailController extends Controller
{
    // Display the email form
    public function showForm()
    {
        return view('send-email-form');
    }

    // Handle the form submission and send the email
    public function sendEmail(Request $request)
    {
        $request->validate([
            'emails' => 'required',
            'message' => 'required',
        ]);
    
        // Split the emails by comma and trim any spaces
        $emails = array_map('trim', explode(',', $request->input('emails')));
        $messageContent = $request->input('message');
    
        // Send email to each recipient
        foreach ($emails as $email) {
            Mail::to($email)->send(new CustomMessageEmail($messageContent));
        }
    
        return back()->with('success', 'Emails sent successfully!');
    }
}
