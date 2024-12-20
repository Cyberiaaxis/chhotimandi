<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/users'; // Define your redirection path

    // Show the login form
    public function showLoginForm()
    {
        // dd(Auth::check());
        if (Auth::check()) {
            return redirect()->intended($this->redirectTo); // Redirect if already logged in
        }

        return view('Staff.pages.login'); // Display the login form
    }

    // Handle the login request
    public function login(Request $request)
    {

        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // If successful, redirect to the intended location
            return redirect()->intended($this->redirectTo);
        }

        // If unsuccessful, redirect back to the login form with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        // dd(auth()->user());
        Auth::logout();

        return redirect()->route('login'); // Redirect to the login page
    }
}
