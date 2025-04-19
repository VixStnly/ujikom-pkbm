<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        // Generate a 4-character random string for CAPTCHA
        $captcha = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);
        session(['captcha' => $captcha]); // Store it in session
    
        return view('auth.login', ['captcha' => $captcha]);
    }
    

    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        'captcha' => ['required'], // Validate CAPTCHA field
    ]);

    // Check if the CAPTCHA is correct
    if ($request->captcha !== session('captcha')) {
        return redirect()->back()->withErrors(['captcha' => 'Captcha Tidak Valid.']);
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil!');
    }

    return redirect()->back()->withErrors(['email' => 'Email Atau Password Salah Silahkan Coba Lagi.']);
}



    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
