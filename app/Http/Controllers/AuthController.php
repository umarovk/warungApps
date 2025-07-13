<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Find user by username
        $user = \App\Models\User::where('username', $credentials['username'])->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    public function createDefaultUser()
    {
        // Check if admin user already exists
        $adminUser = User::where('username', 'admin')->first();
        
        if (!$adminUser) {
            User::create([
                'name' => 'Admin Warung',
                'username' => 'admin',
                'email' => 'admin@warung.com',
                'password' => Hash::make('password123'),
            ]);
            
            return 'Default admin user created successfully!';
        }
        
        return 'Admin user already exists!';
    }
} 