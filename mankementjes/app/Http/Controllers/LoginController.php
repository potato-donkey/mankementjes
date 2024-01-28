<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Inloggegevens onjuist.',
        ])->onlyInput('email');
    }

    public function create(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'new_name' => ['required', 'without_spaces', 'max:64'],
            'new_email' => ['required', 'email'],
            'new_password' => ['required'],
            'privacy' => ['required']
        ]);

        // Check if name already exists
        $usernameExists = \App\Models\User::where('name', $credentials['new_name'])->first();
        if ($usernameExists) {
            return back()->withErrors([
                'new_name' => 'Deze gebruikersnaam is al in gebruik.',
            ])->onlyInput('new_name');
        }

        // Check if email already exists
        $emailExists = \App\Models\User::where('email', $credentials['new_email'])->first();
        if ($emailExists) {
            return back()->withErrors([
                'new_email' => 'Dit e-mailadres is al in gebruik.',
            ])->onlyInput('new_email');
        }
        
        $user = \App\Models\User::create([
            'name' => $credentials['new_name'],
            'email' => $credentials['new_email'],
            'password' => Hash::make($credentials['new_password'])
        ]);
        
        Auth::login($user);
        
        return redirect('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}