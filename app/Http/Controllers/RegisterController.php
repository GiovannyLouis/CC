<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function submitForm(Request $request)
    {
        // Validasi tanpa birthdate
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Kirim email konfirmasi
        Mail::to($validated['email'])->send(new RegistrationConfirmation($validated));

        return back()->with('success', 'Registration completed! Check your email for confirmation.');
    }
}