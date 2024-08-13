<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ContactFormController extends Controller
{
    public function show()
    {
        return view('contact');
    }
    public function send(Request $request)
    {
        // form validation

       $data = request()->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'subject' => 'required|string|min:5',
            'message' => 'required|string|min:5'
        ]);

        Mail::to($data['email'])->send(new ContactUsForm($data));

        return redirect()->route('contact')->with('success', __('Your message has been sent successfully!'));
    }
}
