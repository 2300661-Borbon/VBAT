<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::post('/login-temporary', function (Request $request) {
    $email = strtolower($request->input('email'));
    $password = $request->input('password');

    if ($email === 'vbat.admin@gmail.com' && $password === 'admin123') {
        return redirect()->route('admin.users');
    }
    return redirect()->route('user.dashboard');
})->name('login.temp');

Route::post('/register-temporary', function (Request $request) {
    return redirect()->route('user.dashboard');
})->name('register.temp');

// UPDATED: Accepts both GET (anchor links) and POST (form buttons)
Route::match(['get', 'post'], '/logout', function () {
    return redirect()->route('landing');
})->name('logout');

Route::get('/dashboard/user', function () {
    return view('user-dash'); 
})->name('user.dashboard');

/**
 * ADMIN PANEL ROUTES
 */
Route::prefix('admin')->group(function () {
    // Direct admin routes immediately to the user management view
    Route::redirect('/', '/admin/users');
    Route::redirect('/dashboard', '/admin/users');

    Route::get('/users', function () { 
        return view('admin.users'); 
    })->name('admin.users');
});