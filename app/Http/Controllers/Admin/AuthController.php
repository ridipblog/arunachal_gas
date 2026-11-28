<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        try {
            if (Auth::check() && Auth::user()?->is_admin) {
                return redirect()->route('admin.services.index');
            }

            return view('admin.auth.login');
        } catch (Throwable $e) {
            report($e);

            return view('admin.auth.login');
        }
    }

    /**
     * Handle the admin login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            $remember = $request->boolean('remember');

            if (Auth::attempt([...$credentials, 'is_admin' => true], $remember)) {
                $request->session()->regenerate();

                return redirect()->intended(route('admin.services.index'))
                    ->with('success', 'Welcome back to Arunachal Gas Admin Panel!');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our admin records.',
            ])->onlyInput('email');
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors([
                'email' => 'An unexpected error occurred while signing in. Please try again.',
            ])->onlyInput('email');
        }
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('success', 'You have been safely logged out.');
        } catch (Throwable $e) {
            report($e);

            return redirect()->route('admin.login');
        }
    }
}
