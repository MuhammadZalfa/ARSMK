<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email', 'remember-me'));
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember-me');

        // Use the custom verifyCredentials method
        $user = User::verifyCredentials($credentials['email'], $credentials['password']);

        if ($user) {
            // Log the user in
            Auth::login($user, $remember);

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Redirect to intended page or dashboard
            return redirect()->intended('admin')
                ->with('success', 'You have successfully logged in');
        }

        // Authentication failed
        return redirect()->back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email', 'remember-me'));
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect('/')
            ->with('success', 'You have been logged out successfully');
    }
}