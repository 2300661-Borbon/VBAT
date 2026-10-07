<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Handle Login with Multi-Guard Check
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Check if the login belongs to an Admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.users');
        }

        // 2. Check if the login belongs to a Regular User
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:student,tourist',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
            ],
        ]);

        $user = User::create([
            'role' => $validated['role'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('user.dashboard');
    }

    // Handle Custom Password Update (Forgot Password)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
            ],
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            // Explicit assignment and save() to prevent mass-assignment blocking
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('landing')->with('status', 'Password updated successfully! You can now log in.');
    }

    // Handle Google OAuth Session Sync from Supabase
    public function handleGoogleSession(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'nullable|string',
        ]);

        // Check if signing-in email belongs to an existing Admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();

            return response()->json([
                'status' => 'success',
                'redirect' => route('admin.users'),
            ]);
        }

        // Otherwise, locate or create as a regular user
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name ?? 'Google User',
                'password' => Hash::make(Str::random(24)),
                'role' => 'tourist',
            ]
        );

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'redirect' => route('user.dashboard'),
        ]);
    }

    // Handle Logout for Active Guard
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}